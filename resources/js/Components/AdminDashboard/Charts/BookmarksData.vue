<script setup>
import { Chart } from './ChartInit.js';
import { onBeforeMount } from 'vue';
import { Doughnut } from 'vue-chartjs';
import Pagination from './Pagination.vue';

const props = defineProps({
    bookmarks: Object
})
const emit = defineEmits(['handlePaginate'])

// Forward event to emit for parent handler
const forwardPaginate = (url, comp) => {
    emit('handlePaginate', url, comp)
}

const bookmarks = {

    data:  {

        datasets: [{

            // Aside from data (which is required to calculate portions in graph), all others are custom
            // label: "Bookmarks by popularity", 
            // data calculated for bars to display - data is not custom
            data: props.bookmarks.data.map(bkmrk => bkmrk.count),
            // article titles set so can be ref'd in footer below
            titles: props.bookmarks.data.map(bkmrk => bkmrk.title.slice(0, 25)),
            // Publication names - need for label display
            publications: props.bookmarks.data.map(bkmrk => 
            bkmrk.publication.name)                 
        } ],
        },
        options: {
            plugins: {
                // Display title of graph
                title: {
                    display: true,
                        text: "Bookmarks"
                    },
                //title, publication, and bookmarks in the hover tooltip
                tooltip: {
                    callbacks: {
                        // Dipaly data in top half of tooltip - context ref's x & Y data at intersection
                        // which is passed below
                        label: function (context) {
                            // Shows article title above publication
                            // Array is used to separate lines in display
                            return [`${context.dataset.titles[context.dataIndex]}...`,
                                    `${context.dataset.publications[context.dataIndex]}`]
                        },
                        // Show total bookmarks in footer of tooltip
                        footer: function (context) { // footer context is different to label, above
                            return `Bookmarks: ${context[0].dataset.data[context[0].dataIndex]}`
                        }
                    }
                }

                }
            }

}
// Load chart before rendering
onBeforeMount(() => {
  Chart()
})

</script>

<template>

    <div class="bg-white p-4 rounded-lg shadow-md">

        <Doughnut :data="bookmarks.data" :options="bookmarks.options"/>

        <!-- Paginate if needed -->
        <!-- comp="" passes name of component to be rendered with new data -->
        <Pagination v-if="props.bookmarks.last_page > 1" 
                        :links="props.bookmarks.links"
                        comp="bookmarks"
                        @handlePaginate="forwardPaginate"/> 

    </div>

</template>