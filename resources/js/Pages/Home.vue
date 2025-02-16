<script setup lang="ts">

import SideBar from '@/Components/Home/SideBar.vue';
import Header from '@/Components/Home/Header.vue';
import ArticleCard from '@/Components/Home/ArticleCard.vue';

const props = defineProps({
    title: String,
    data: Object
})

console.log("data is", props.data)

</script>

<template>

<body class="bg-black text-white font-sans">
    <div class="flex h-screen">

            <SideBar />
        
            <!-- main content area -->
            <main class="flex-1 p-6 overflow-auto">

                <!-- Page header -->
                <Header/>

                <!-- wrapper for content -->
                <div class="space-y-6">

                    <h1 class="text-3xl font-bold mb-6">{{ props.title }}</h1>
                        
                       <div class="w-full flex flex-wrap gap-6">

                            <ArticleCard v-for="article in props.data.articles" 
                                                    :article="article"/>

                        
                        </div> 
                </div>

            </main>
   
        </div>  
    </body>


</template>