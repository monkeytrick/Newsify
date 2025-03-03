<script setup>
import { ref } from 'vue';
import countryList from './country-list';

const props = defineProps({
    getData: Function
})

// Display selected country in input field
const showSelected = ref("");
const placeHolder = ref("country")

const fetchCountry = (country)=> {

    // Check exists - no error. Return country code
    const countryCode = countryList.find(country => country.name === showSelected.value).code

    if(countryCode == undefined) {
        placeHolder.value = "Error with country"
        return;
    }

    console.log("Country code is ", countryCode)

    // Country name is not returned by API data. Need to pass
    // this to display with results.
    props.getData({name: showSelected.value,
                   code: countryCode})
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
                v-model="showSelected"  
                @change="fetchCountry(showSelected.value)">

    <datalist id="countries">
        <option v-for="country in countryList" :key="country.code" :value="country.name"/>
    </datalist>

</template>