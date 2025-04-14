<script setup>

import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';

// Handle global variables. Here, check whether login status 
// is set to true to conditionally render login/out buttons
const page = usePage()

// Handle open search 
const userInput = ref('')
const errorMsg = ref('')

const submitRequest = () => {
    console.log("input is ", userInput.value)
    
    //check field is not empty
    if(userInput.value.trim() === '') {
        errorMsg.value = "Enter valid text"
        return;
    }
    // Encode request for API query
    const query = encodeURIComponent(userInput.value)
}

const logout = ()=> {
    axios.post("/logout")
}

</script>

<template>

<div class="grid grid-cols-[auto_1fr_auto] items-center w-full">

    <div class="justify-self-center">
        <form @submit.prevent="submitRequest" class="max-w-md mx-auto">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input v-model="userInput" type="search" id="default-search" class="w-64 block p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search area..." required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                <p v-if="errorMsg !== ''"> {{ errorMsg }}</p>
            </div>
        </form>
    </div>
    <div class="justify-self-end">

        <!-- Need to change this. Currently, user is redirected to Jetstream's login page.
        Would need to render a dropdown login form and have user input posted to backend
        via a function. Similar to the logout function. -->
        <Link v-if="page.props.auth.user == null" :href="route('login')" class="bg-green-400 text-white p-2 rounded hover:bg-blue-600">Log in/Register</Link>
        <!-- <Link v-else href="/trial" class="bg-green-400 text-white p-2 rounded hover:bg-blue-600">Log out</Link> -->
        <div v-else @click="logout" class="bg-green-400 text-white p-2 rounded hover:bg-blue-600">Log out</div>
    </div>

</div>

</template>