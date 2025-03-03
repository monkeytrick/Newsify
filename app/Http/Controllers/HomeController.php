<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsAPIService;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller

{   
    // public function test(NewsAPIService $newsAPI) {

    //     $sources = $newsAPI->sources();

    //     foreach($sources['sources'] as $source) {

    //         print_r("Publisher is " . $source['name']);


    //     }
    // }

    //

    // Home page
    public function index(NewsAPIService $newsAPI) {

        $data = $newsAPI->headlines();

        return Inertia::render('Home', ['title' => 'Latest News', 'data' => $data]);

    }

    // News by country 
    public function country(Request $request, NewsAPIService $newsAPI, $country, $code) {

        Log::info('Request Headers for router.get:', $request->headers->all());

        $data = $newsAPI->country($code);

        // $country = $request->input('name');

        return Inertia::render('Home', ['title' => "News for {$country}", 'data' => $data]);
    }

    public function category(NewsAPIService $newsAPI, Request $request, string $category) {

        Log::info('Request Headers for category'. $category);

        $data = $newsAPI->category($category);

        // Log::info('data is', $data);

        return Inertia::render('Home', ['title' => "News for {$category}", 'data' => $data]);
    }

    // Need to convert to URLencoded in front-end and check this 
    // in back-end
    public function query(NewsAPIService $newsAPI, string $query) {

        Log::info('Query request for ' . $query);

        $data = $newsAPI->query($query);

        return Inertia::render('Home', ['title' => "News for '{$query}'", 'data' => $data]);
    }
}
