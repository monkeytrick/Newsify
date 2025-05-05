<script setup>

import { router } from '@inertiajs/vue3';

// Sidebar
import AdminSidebar from '@/Components/AdminDashboard/AdminSidebar.vue';
import ArticlesData from '@/Components/AdminDashboard/Charts/ArticlesData.vue';
import BookmarksData from '@/Components/AdminDashboard/Charts/BookmarksData.vue';
import PublicationsData from '@/Components/AdminDashboard/Charts/PublicationsData.vue';

const props = defineProps({ articles: Object,
                            bookmarks: Object,
                            publications: Object
                        })


// Paginate graph data
// 'comp' is name of prop to update
const handlePaginate = (url, comp) => {
    // Partial reload - requests data and refreshes
    // only the specified prop 
    router.visit(url, {
        only: [comp],
        // preserveState: true,
})

}


</script>

<template>

    <body class="bg-black text-white font-sans">

        <div class="flex h-screen">

            <!-- Sidebar displays options for admin only -->
            <AdminSidebar />

            <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
                <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

                <!-- Chart Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> 
                    
                    <!-- Articles by popularity -->
                    <ArticlesData :articles="props.articles"
                                  @handlePaginate="handlePaginate" />

                    <!-- Bookmarks by popularity -->
                    <BookmarksData :bookmarks="props.bookmarks"
                                   @handlePaginate="handlePaginate"/>

                    <!-- News sources by popularity -->
                    <PublicationsData :publications="props.publications"
                                      @handlePaginate="handlePaginate"/>

                </div>
            </main>

        </div>

    </body>

</template>