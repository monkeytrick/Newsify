<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsAPIService;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    //
    public function index(NewsAPIService $newsAPI) {

        $data = $newsAPI->headlines();

        // return $data;
        // Log::notice("data is ". $data);

        // return response()->json(['data' => $data]);
        return Inertia::render('Home', ['title' => 'Latest', 'data' => $data]);

        // return Inertia::render('Home', ['event_data' => $results, 
        // 'title' => "Results for {$results['location']}"]);
    }

    public function country(NewsAPIService $newsAPI, Request $request, string $country) {

        return $newsAPI->country($country);
    }

    public function category(NewsAPIService $newsAPI, Request $request, string $category) {

        return $newsAPI->country($category);
    }

    // Need to convert to URLencoded in front-end and check this 
    // in back-end
    public function query(NewsAPIService $newsAPI) {

        return $newsAPI->query("bananas");
    }
}
