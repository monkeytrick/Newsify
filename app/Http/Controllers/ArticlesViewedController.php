<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ArticlesViewed;

class ArticlesViewedController extends Controller
{
    //

    public function exists(Request $request) {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publication' => 'required|string|max:255'
        ]);

        $article = ArticlesViewed::where('title', $validated['title'])
                        ->where('publication_name', $validated['publication_name'])
                        ->first();

        if($article) {
            $article->increment('count');
            return "true";
        }

        else {
            $article::create()
        }

        
        // return "controller reached";
    }
}
