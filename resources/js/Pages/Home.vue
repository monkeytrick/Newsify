<script setup>

import { ref } from 'vue';
import SideBar from '@/Components/SideBar.vue';
import Header from '@/Components/Header.vue';
import ArticleCard from '@/Components/ArticleCard.vue';
import { router } from '@inertiajs/vue3';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';

const state = ref({
    loading: false
})

const Modal = ref(false)

const changeModal = ()=> {
    Modal.value = !Modal
    console.log("reached like anything")
}

const showModal = () => {
    Modal.value = true
    console.log("Modal")
};

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

</script>

<template>

<body class="bg-black text-white font-sans">

    <ConfirmationModal :show="Modal" @changeModal="changeModal"/>
    
    <div class="flex h-screen">

            <SideBar :getData="getData"/>
        
            <!-- main content area -->
            <main class="flex-1 p-6 overflow-auto">

                <button @click="showModal">Modal</button>

                <!-- Page header -->
                <Header/>

                <!-- wrapper for content -->
                <div class="space-y-6">

                    <h1 class="text-3xl font-bold my-10">{{ props.title }}</h1>
                        
                        <div class="w-full flex flex-wrap gap-6">

                            <!-- Article cards -->
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