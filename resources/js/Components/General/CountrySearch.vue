<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import countryList from './country-list';

defineEmits(['countryArticles'])

// Display selected country in input field
const country = ref("");
const placeHolder = ref("country")

const fetchCountry = ()=> {

    // Check exists in list array - no error. Return country code
    const countryCode = countryList.find(cnt => cnt.name === country.value).code

    if(countryCode == undefined) {
        placeHolder.value = "Error with country"
        return;
    }

    //Request data
    // Country name is not returned by API data. Need to pass
    // this to display with results.
    router.get(`/country/${country.value}/${countryCode}`)
}

</script>


<style scoped>
/* Add styling to make the text visible */
input {
  color: black; /* Make sure text is black */
  background-color: white; /* Ensure the background is white */
  padding: 8px;
  font-size: 16px;
}
</style>

<template>

    <label for="country"></label>

    <input list="countries" id="country" name="country" :placeholder=placeHolder 
                v-model="country"  
                @change="fetchCountry">

    <datalist id="countries">
        <option v-for="country in countryList" :key="country.code" :value="country.name"/>
    </datalist>

</template>