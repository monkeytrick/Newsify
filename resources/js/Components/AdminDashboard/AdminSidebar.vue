<script setup>

import { Link } from '@inertiajs/vue3';

    const categories = [{
                            id: 'users',
                            name: 'Users',
                        },
                        {
                            id: 'publications',
                            name: 'Publications'
                        },
                        {
                            id: 'bookmarks',
                            name: 'Bookmarks',
                        }]

</script>

<template>

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 p-4 flex flex-col space-y-6">
            <h1 class="text-2xl font-bold text-green-400">Newsify - Admin</h1>

            <ul class="group cursor-pointer relative w-40 p-2 space-y-4">
                <ul absolute left-0 mt-2 w-40 bg-gray-700 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200>
                    <li v-for="category in categories" 
                              class="hover:bg-gray-600">

                              <Link :href="`/admin/${category.id}`">
                                     {{ category.name }}
                              </Link>
                              
                    </li>

                </ul>

            </ul>
        </aside>
</template>