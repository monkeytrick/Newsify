<script setup>
import axios from 'axios';
import { router } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

    const props = defineProps({
        article: Object
    })

    // State for loading image
    const imgLoading = ref(true)

    // State for bookmarks
    const bookmrk = ref(false)


    const imgError = () => {
        imgLoading.value = false
        console.log('imge error')
        event.target.src = "images/placeholder.png"
    }

    const HandleBookmark = ()=> {
        console.log("Bookmark clicked")

        bookmrk.value = !bookmrk.value

        //Send request to DB - avoid duplicates by checking exists already
        

    }

    // Add article to db when viewed or increment view count
    const handler = (article) => {

        const data = {
            title: article.title,
            publication: article.source.name,
            url: article.url,            
        }
        
        const resp = axios.post('/article-viewed', 
                                    {
                                      title: data.title,
                                      publication: data.publication,
                                      url: data.url

                                    })
                            .then(res => {
                                if(res.data == false) {
                                    console.log('false');
                                }
                            })
                            .catch(error => console.log(error))
    }

</script>

<template>

        <div @click="handler(props.article)" class="w-[30%] bg-gray-800 p-4 rounded-lg">

            <!-- Bookmark icon -->
            <div class="flex justify-end items-end">
                <!-- .stop prevents bubbling to article click -->
                <svg :class="bookmrk ? 'fill-current text-green-400' : 'fill-none'" @click.stop="HandleBookmark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mb-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                </svg>
            </div>

            <a :href="article.url">
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
                    <img src="images/placeholder.png" alt="placeholder-img">
                </div>
               
                <h5 class="mt-2 font-bold text-center"> {{ props.article.source.name }}</h5>
            </a>
        </div>

</template>