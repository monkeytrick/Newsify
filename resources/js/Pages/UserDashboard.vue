<script setup>

import { ref } from 'vue';
import SideBar from '@/Components/SideBar.vue';
import Header from '@/Components/Header.vue';
import ArticleCard from '@/Components/ArticleCard.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import axios from 'axios';

const props = defineProps({
    title: String,
    data: Object,
})


// Set props to reactive so that they can be 
// filtered after one is deleted
const articles = ref(
    props.data.articles
)

// Set URL for request
const URL = ref('')

// Set article Id and bookmark for delete
const id = ref({});

// Handle delete request modal and URL
const modal = ref(false)
// Set message in modal
const modalTxt = ref('')

const changeModal = ()=> {
    modal.value = !modal
}

// Open delete confirmation modal and
// set URL to be called if delete conf'd
const confirmDelete = (ids)=> {

    // Set article ID for filter and URL
    id.value = ids

    // set URL to call
    URL.value = `/user/bookmark/delete/${id.value.articleId}/${id.value.bookmarkId}`

    // Trigger modal and set text 
    modalTxt.value = "Delete bookmark?"
    modal.value = true
}

// Handle modal confirmation. 
// Send delete request and update displayed articles if successful.
const handleRequest = () => {

    axios.delete(URL.value)
        .then(resp => {
            if(resp.status !== 200) {
                throw Error("Delete request error")
            }
            // Success message is returned upon deletion
            if(!resp.data.success) {
                throw Error('Delete request error')
            }
            // Remove deleted article
            articles.value = articles.value.filter(article => article.bookmarkId !== id.value.bookmarkId )
            // Show modal message
             modalTxt.value = 'Article deleted'
             // close modal
             modal.value = false
        })
        .catch(error => {
            modalTxt.value = `Error: ${error.message}`
        }
        )
}

</script>

<template>

    <body class="bg-black text-white font-sans">

        <!-- Currently handles delete bookmark request, but maybe set to handle others -->
        <ConfirmationModal :show="modal" 
                           :modalTxt="modalTxt"
                           @handleRequest="handleRequest"
                           @changeModal="changeModal"/>

        <div class="flex h-screen">
    
                <SideBar />
            
                <!-- main content area -->
                <main class="flex-1 p-6 overflow-auto">
    
                    <!-- Page header -->
                    <Header/>
    
                    <!-- wrapper for content -->
                    <div class="space-y-6">
    
                        <h1 class="text-3xl font-bold my-10">{{ props.title }}</h1>
                            
                            <div class="w-full flex flex-wrap gap-6">
    
                                <!-- Article cards -->
                                <template v-if="props.data.totalResults !== 0">
                                    <ArticleCard v-for="article in articles" 
                                                        :article="article" 
                                                        @confirmDelete="confirmDelete"
                                                        />
                                </template>
                                <div v-else class="text-xl">
                                    <h2>Sorry, no results were found</h2>
                                </div>
                          
                            </div> 
                    </div>
    
                </main>
       
            </div>  
        </body>
    
    </template>

