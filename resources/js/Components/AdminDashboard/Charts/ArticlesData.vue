<script setup>
import { Chart } from './ChartInit.js';
import { Bar } from 'vue-chartjs';
import Pagination from './Pagination.vue';
import { onBeforeMount } from 'vue';


const props = defineProps({
    articles: Object
})


const emit = defineEmits(['handlePaginate'])

// Forward event to emit for parent handler
const forwardPaginate = (url, comp) => {
    emit('handlePaginate', url, comp)
}

const articles = {

     data: {
        // X axis labels
        labels: props.articles.data.map(article => article.title.slice(0, 10)),
        datasets: [{
            label: "Articles by popularity", 
            // data for bars
            data: props.articles.data.map(article => article.views) 
         }],
     },
     options: {
        plugins: {
            // Chart title
            title: {
                display: true,
                    text: "Articles"
                }
            },

        }
}

onBeforeMount(() => Chart())

</script>

<template>

    <div class="bg-white p-4 rounded-lg shadow-md">
       
        <Bar :data="articles.data" :options="articles.options"/>  <!-- Not a custom component -->
        
        <!-- Paginate if needed -->
        <!-- comp="" passes name of component to be rendered with new data -->
        <Pagination v-if="props.articles.last_page > 1" 
                         :links="props.articles.links"
                          comp="articles"
                          @handlePaginate="forwardPaginate"/> 
     </div>

</template>