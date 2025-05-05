<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminDataService;

use Inertia\Inertia;

class AdminController extends Controller
{
    // Homepage  - returns data for all graphs
    public function index (Request $request, AdminDataService $data) {

        // Homepage. Returns data for charts
        $all_data = $data->all_data();

        return Inertia::render('AdminDashboard', ['articles' => $all_data['articles'],
                                                  'bookmarks' => $all_data['bookmarks'],
                                                  'publications' => $all_data['publications']
        ]);
    }

    // Paginated articles
    public function articles (AdminDataService $data) {
        
        $articles = $data->articles_pop();

        return Inertia::render('AdminDashboard',  ['articles' => $articles]);

    }

    // Paginated bookmarks
    public function bookmarks (AdminDataService $data) {
    
        $bookmarks = $data->bookmarks_pop();

        return Inertia::render('AdminDashboard',  ['bookmarks' => $bookmarks]);

    }
    
    // Paginated publications
    public function publications (AdminDataService $data) {
    
        $publications = $data->publications_pop();

        return Inertia::render('AdminDashboard',  ['publications' => $publications]);

    }
}
