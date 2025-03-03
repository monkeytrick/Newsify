<script setup>

import { Inertia } from '@inertiajs/inertia';
import { onMounted, ref } from 'vue';
import SideBar from '@/Components/Home/SideBar.vue';
import Header from '@/Components/Home/Header.vue';
import ArticleCard from '@/Components/Home/ArticleCard.vue';
import { router } from '@inertiajs/vue3';

const state = ref({
    loading: false
})

const props = defineProps({
    title: String,
    data: Object,
})

const getData = (country)=> {

    state.value.loading = true;

    router.get(`/country/${country.name}/${country.code}`, {}, {
        preserveState: true, // Keeps page state intact
    }).then(res => state.value.loading = false);

}

onMounted(() => {
    console.log("results are ", props.data.totalResults)
})

</script>

<template>

<body class="bg-black text-white font-sans">
    <div class="flex h-screen">

            <SideBar :getData="getData"/>
        
            <!-- main content area -->
            <main class="flex-1 p-6 overflow-auto">

                <!-- Page header -->
                <Header/>

                <!-- wrapper for content -->
                <div class="space-y-6">

                    <h1 class="text-3xl font-bold my-10">{{ props.title }}</h1>
                        
                       <div class="w-full flex flex-wrap gap-6">

                            <template v-if="props.data.totalResults !== 0">
                                <ArticleCard v-for="article in props.data.articles" 
                                :article="article"/>
                            </template>
                            <div v-else class="text-xl">
                                <h2>Sorry, no results were found</h2>
                            </div>
                      
                        </div> 
                </div>

            </main>
   
        </div>  
    </body>

</template>