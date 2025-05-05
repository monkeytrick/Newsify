<script setup>

import { ref } from 'vue'
import axios from 'axios'

// Handles the general add or deletion of bookmark
// appears only when user is logged in

const props = defineProps({article:Object})

// State for whether article is bookmarked
const bookmrk = ref(null)

const postRequest = (url, data)=> {
    return axios.post(url, data)
            .then(res => {
                if(res.data) {
                    return res.data
                } else {
                    throw new Error("Bookmark error")
                }
            })
            .catch(error => console.log(error))
}

// Delete bookmark
const deleteRequest = (url) => {
    console.log(`sending delete request to ${url}`)
    return axios.delete(url)
            .then(res => {
                if(res.data) {
                    console.log('delete msg returned ', res.data)
                    return res.data
                } else {
                    throw new Error("Bookmark delete error")
                }
            })
            .catch(error => console.log(error))
}

// Add or delete user bookmark
const HandleBookmark = ()=> {

    // Check article is not already bookmarked
    if(!bookmrk.value) {

    // Add bookmark
       postRequest('/user/bookmark',  {
                                        title: props.article.title,
                                        publication: props.article.publication,
                                        url: props.article.url,  
                                        urlToImg: props.article.urlToImg
                                    })
        .then(res => {
            if(res) {
            
            // Update bookmark state with bookmark dets
                bookmrk.value = {
                // User's bookmark ID
                bookmarkId: res.bookmarkId.id,
                // article ID
                articleId: res.bookmarkId.bookmark_id
            }
            console.log("new bookmark is ", bookmrk.value)
            }
        }).catch(e => console.log("Bookmark error", e))
    }

    // Delete user bookmark
    else {
        deleteRequest(`/user/bookmark/delete/${bookmrk.value.articleId}/${bookmrk.value.bookmarkId}`)
                    .then(res => {
                        if(res.success) {
                            // Empty bookmark value
                            bookmrk.value = null
                            console.log('bookmark deleted', bookmrk.value)

                        }
                        else {
                            console.log('bookmark error')
                        }
                    })
    }  

}
</script>
<template>

    <div class="flex justify-end items-end">
        <!-- .stop prevents bubbling to article click -->
        <svg :class="bookmrk ? 'fill-current text-green-400' : 'fill-none'" @click.stop="HandleBookmark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mb-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
        </svg>
    </div>

</template>