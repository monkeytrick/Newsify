<script setup>

import { Chart } from './ChartInit.js';
import { onBeforeMount } from 'vue';
import { PolarArea } from 'vue-chartjs';
import Pagination from './Pagination.vue';

const props = defineProps({
    publications: Object
})

const emit = defineEmits(['handlePaginate'])

// Forward event to emit for parent handler
const forwardPaginate = (url, comp) => {
    emit('handlePaginate', url, comp)
}

const publications = {

    data: {

        labels: props.publications.data.map(publication => publication.name),
        datasets: [ {
            data: props.publications.data.map(publication => publication.views)
            } ]
    }, 
    options: {
        plugins: {
            title: {
                display: true,
                text: "Publications"
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return `Views ${context.raw}`
                    }
                }
            }
        }
    }
}

// Load chart before rendering
// onBeforeMount(() => {
//   Chart()
// })
</script>

<template>

    <div class="bg-white p-4 rounded-lg shadow-md">

        <PolarArea :data="publications.data" :options="publications.options"/>

        <!-- Paginate if needed -->
        <!-- comp="" passes name of component to be rendered with new data -->
        <Pagination v-if="props.publications.last_page > 1" 
                    :links="props.publications.links"
                    comp="publications"
                    @handlePaginate="forwardPaginate"/> 

    </div>

</template>

