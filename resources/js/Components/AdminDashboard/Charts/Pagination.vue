<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
    links: Array,
    comp: String
})

const emit = defineEmits(['handlePaginate'])

const Paginate = (url) => {
    // Event name, paginated url, prop to be updated (for partial reload)
    emit('handlePaginate', url, props.comp)
}

</script>

<template>
    <nav class="inline-flex items-center space-x-2" aria-label="Pagination">

        <!-- Render colors conditionally for active page number -->
        <button v-for="link in links" :key="link.label"
                            :class="link.active ? 'bg-green-600 border-green-400 text-white' : 
                            'bg-white-600 border-white-600 text-black'"
                            class="px-4 py-2 text-sm font-medium 
                            link border 
                            rounded hover:bg-blue-700"
                            @click="Paginate(link.url)">
                    {{ link.label }}
        </button>

   </nav>
</template>