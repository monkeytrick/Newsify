<script setup>

import { Link, usePage } from '@inertiajs/vue3';

import CountrySearch from './General/CountrySearch.vue';

const props = defineProps({
    getData: Function
})

// Access user logged in dets from global variables (not props)
const page = usePage();

    const categories = [{
                            id: 'business',
                            name: 'Business',
                        },
                        {
                            id: 'entertainment',
                            name: 'Entertainment'
                        },
                        {
                            id: 'general',
                            name: 'General',
                        },
                        {
                            id: 'health',
                            name: 'Health'
                        },
                        {
                            id: 'science',
                            name: 'Science'
                        },
                        {
                            id: 'sport',
                            name: 'Sport'
                        },
                        {
                            id: 'technology',
                            name: 'Technology'
                        }]

</script>

<template>

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 p-4 flex flex-col space-y-6">
            <h1 class="text-2xl font-bold text-green-400">Newsify</h1>

            <Link v-if="page.props.auth.user" 
                        :href="'/user/bookmarks'" 
                        class="relative w-40 p-2 space-y-4">
                        Bookmarks
            </Link>

            <ul class="group cursor-pointer relative w-40 p-2 space-y-4">
                <li class="hover:text-green-400">Category</li>
                <ul absolute left-0 mt-2 w-40 bg-gray-700 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200>
                    <li v-for="category in categories" 
                              class="hover:bg-gray-600">

                              <Link :href="`/category/${category.id}`">
                                     {{ category.name }}
                              </Link>
                              
                    </li>

                </ul>

                <CountrySearch :getData="getData"/>

            </ul>
        </aside>


</template>