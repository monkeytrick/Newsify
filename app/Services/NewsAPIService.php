<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class NewsAPIService {

    private string $key;
    private string $baseURL = "https://newsapi.org/v2/";
    private object $HttpClient;

    public function __construct($key, $HttpClient)
    {
        $this->key = $key;
        $this->HttpClient = $HttpClient;

    }

     // General. Used for homepage 
    public function headlines(){

        $url = "{$this->baseURL}top-headlines?language=en&sortBy=popularity&apiKey={$this->key}";
        return $this->APIcall($url);
    }

    public function country(string $country){
        //-Must use top-headlines when specifying country. 'everything' does not work.
        // Cannot specify dates
        $url = "{$this->baseURL}top-headlines?country={$country}&sortBy=popularity&apiKey={$this->key}";
        return $this->APIcall($url);

    }

    public function category($category){
        
        //-Must use top-headlines when specifying category. 'everything' does not work.
        // Cannot specify dates
        // Categories are business, entertainment, general, health, science, sports, technology
        $url = "{$this->baseURL}top-headlines?category={$category}&sortBy=popularity&apiKey={$this->key}";
        return $this->APIcall($url);
    }

    // Will need to first get the list of available resources from
    // front-end API call, as these are not available
    public function sources($sources){
        
    }

    public function query(string $query){

        // Need to URL encode - https://newsapi.org/docs/endpoints/everything

        // https://newsapi.org/v2/everything?q=cars&apiKey=d0246a4f43ca4d6cbaf0bd8f8f020583
        $url = "{$this->baseURL}/everything?q={$query}&language=en&sortBy=popularity&apiKey={$this->key}";

        return $this->APIcall($url);
        
    }

    public function APIcall(string $url) {

        $data = $this->HttpClient::get($url);
        // return $this->HttpClient::get($url);

        if(!$data->successful()) {
            Log::error("API error retrieving data for {$url}");
            return [
                'success' => false,
                'error' => 'Could not retrive data'
            ];
        };

        return $data->json();
    }

}
