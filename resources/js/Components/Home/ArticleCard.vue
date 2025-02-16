<script setup>
    const props = defineProps({
        article: Object
    })
    console.log("card prop is ", props.event)

    // On and off focus - trigger event that pulls up card
</script>

<template>

        <div class="w-[30%] bg-gray-800 p-4 rounded-lg">
            <h4 class="mt-2 font-bold text-center"> {{ props.article.title }}</h4>
            <img v-if="props.article.urlToImage !== null" :src="props.article.urlToImage" class="w-full rounded" alt="Playlist">
            <img v-else src="images/placeholder.png">
            
            <h5 class="mt-2 font-bold text-center"> {{ props.article.source.name }}</h5>
        </div>

</template>