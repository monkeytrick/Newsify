<script setup>

import axios from 'axios'

// function to delete bookmark
// needs to send bookmark and user will be worked out on back end

const emit = defineEmits(['confirmDelete'])

const props = defineProps({
    bookmarkId: Number,
    articleId: Number
})

const deleteBookmark = () => {
 
    emit('confirmDelete', { articleId: props.articleId, 
                            bookmarkId: props.bookmarkId })

}

</script>

<template>
    <div @click.stop="deleteBookmark()" class="flex justify-end items-end" >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m3 3 1.664 1.664M21 21l-1.5-1.5m-5.485-1.242L12 17.25 4.5 21V8.742m.164-4.078a2.15 2.15 0 0 1 1.743-1.342 48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185V19.5M4.664 4.664 19.5 19.5" />
        </svg>
    </div>
</template>