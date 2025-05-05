<script setup>

import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import Search from './General/Search.vue';

// Handle global variables. Here, check whether login status 
// is set to true to conditionally render login/out buttons
const page = usePage()

const logout = ()=> {
    axios.post("/logout")
}

</script>

<template>

<div class="grid grid-cols-[auto_1fr_auto] items-center w-full">

    <Search />

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