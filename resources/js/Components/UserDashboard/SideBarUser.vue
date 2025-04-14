<script setup>

import { Link, usePage } from '@inertiajs/vue3';
import CountrySearch from '../General/CountrySearch.vue';

const page = usePage();

const props = defineProps({
    getData: Function
})
    // Sidebar categories
    const categories = [ {
                          id: 'latest',
                          name: 'Latest',
                          url: 'dasds'
                         },        
                         {
                           id: 'bookmarks',
                           name: 'Bookmarks',
                           url: '/user/bookmarks'
                            }
                    ]


</script>

<template>

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 p-4 flex flex-col space-y-6">
            <h1 class="text-2xl font-bold text-green-400">Newsify</h1>
            <ul class="group cursor-pointer relative w-40 p-2 space-y-4">
                    <li v-for="category in categories" 
                              class="hover:bg-gray-600">

                              <Link :href="`${category.url}`">
                                     {{ category.name }}
                              </Link>
                              
                    </li>

                <CountrySearch :getData="getData"/>

            </ul>
        </aside>


</template>