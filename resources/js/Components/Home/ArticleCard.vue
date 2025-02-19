<script setup>
import axios from 'axios';

    const props = defineProps({
        article: Object
    })
    console.log("card prop is ", props.event)

    // Check if article exists in db based on title. If does increase read count by 1
    // If does not check publisher on db. 
                    // If not get country by calling sources endpoint and storing value as country
                    // add publisher to publishers db - return new id
                    // add article and publishers id
                // if it does return id and add article to db

    // Above solution allows for dynamic updating of news sources as these are added to NewsAPI, though does involve
    // More DB queries.

    // Alternate solution would be to have DB query check daily for new sources added and update publishers table when 
    // required.

    //send click details to back-end
    const handler = (article) => {

        const data = {
            title: article.title,
            publication: article.source.name,
            url: article.url,            
        }
        
        const resp = axios.post('/article-exists', 
                                    {
                                      title: data.title,
                                      publication: data.publication

                                    })
                            .then(res => {
                                if(res.data == false) {
                                    console.log('false');
                                }
                            })
        

        // if response is true redirect
        // if response is false - redirect and then make post request with data
    }


    // On and off focus - trigger event that pulls up card
</script>

<template>

        <div @click="handler(props.article)" class="w-[30%] bg-gray-800 p-4 rounded-lg">
            <h4 class="mt-2 font-bold text-center"> {{ props.article.title }}</h4>
            <img v-if="props.article.urlToImage !== null" :src="props.article.urlToImage" class="w-full rounded" alt="Playlist">
            <img v-else src="images/placeholder.png">
            
            <h5 class="mt-2 font-bold text-center"> {{ props.article.source.name }}</h5>
        </div>

</template>