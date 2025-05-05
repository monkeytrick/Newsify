<script setup>
import axios from 'axios';
import { router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import Bookmark from './UserDashboard/Bookmark.vue';
import BookmarkDelete from './UserDashboard/BookmarkDelete.vue';
import { usePage } from '@inertiajs/vue3';

// Access global variables, such as checking user is logged in
// for conditional render
const page = usePage()


const props = defineProps({
    article: Object,
});


// State for loading image
const imgLoading = ref(true)


// Send only necessary details for bookmark to be added to db
const bkMrkDets = computed(() => ({ 
        title: props.article.title,
        publication: props.article.source.name,
        url: props.article.url,  
        urlToImg: props.article.urlToImage
}))

// State for whether article is bookmarked
// const bookmrk = ref(null)

defineEmits(['confirmDelete'])


const imgError = (event) => {
    console.log('imge error')
    event.target.src = "/images/placeholder.png"
    imgLoading.value = false
}

const errorMsg = reactive( { display: false, msg: "" } )

// Add article to db when viewed, or increment view count
// and open article in new window
const articleHandler = () => {

    // Send request to increment view count - not visible to user
    axios.post('/article-viewed',  {
                title: props.article.title,
                publication: props.article.source.name,
                url: props.article.url,    
                })
                .then(resp => {

                    if(resp.status !== 200) {
                        throw Error("Could not post data")
                    }

                    if(!resp.data.success) {
                        throw Error("Could not add data")
                    }
               })
                .catch(e => console.log(e))

    window.open(props.article.url, '_blank', 'noopener,noreferrer')
}


</script>

<template>

        <div @click="articleHandler()" class="w-[30%] bg-gray-800 p-4 rounded-lg">
            <!-- Display error -->
             <template v-if="errorMsg.display">{{ errorMsg.msg }}</template>
            <!-- Display delete bookmark icon if article bookmarked (only shows with logged in user)-->
            <template v-if="props.article.bookmarkId">
                <BookmarkDelete :bookmarkId="props.article.bookmarkId"
                                :articleId="props.article.articleId"              
                                @confirmDelete="$emit('confirmDelete', $event)"/>
            </template>

            <!-- Bookmark icon -->
            <!-- Display bookmark if user is logged in and bookmark does not already exist -->
            <Bookmark v-if="page.props.auth.user && !props.article.bookmarkId" :article="bkMrkDets"/>

            <!-- <a :href="article.url"> -->
                <h4 class="mt-2 font-bold text-center"> {{ props.article.title.slice(0, 55)  }}...</h4>
                
                <!-- Load the image if url value is not null -->
                <template v-if="props.article.urlToImage !== null">
                    <p v-if="imgLoading">Loading image...</p>
                    <img v-show="!imgLoading"
                        :src="props.article.urlToImage" 
                        @load="imgLoading = false"
                        @error="imgError"
                        alt="artice-image">
                </template>
                <div v-else>
                    <img src="/images/placeholder.png" alt="placeholder-img">
                </div>
               
                <h5 class="mt-2 font-bold text-center"> {{ props.article.source.name }}</h5>
            <!-- </a> -->
        </div>

</template>