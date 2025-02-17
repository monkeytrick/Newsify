<script setup>

    const sideMenu = [{
                            id: 'category',
                            name: 'Category',
                            icon: ''
                        }, 
                        {
                            id: 'search',
                            name: 'Search',
                            icon: ''
                        },
                        {
                            id: 'library',
                            name: 'Library',
                            icon: ''
                        }]

</script>

<template>

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 p-4 flex flex-col space-y-6">
            <h1 class="text-2xl font-bold text-green-400">Newsify</h1>
            <ul class="space-y-4">
                <li v-for="item in sideMenu" href="item" class="hover:text-green-400">{{ item.name }}</li>
                <!-- <li><a href="#" class="hover:text-green-400">Home</a></li>
                <li><a href="#" class="hover:text-green-400">Search</a></li>
                <li><a href="#" class="hover:text-green-400">Your Library</a></li>
                <li><a href="#" class="hover:text-green-400">Premium</a></li> -->
            </ul>
        </aside>


</template>