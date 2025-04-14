<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ArticlesViewed;
use App\Models\Publication;

// Error logging
use Exception;
use Illuminate\Support\Facades\Log;

class ArticlesViewedController extends Controller
{

    public function store(Request $request) {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publication' => 'required|string|max:255',
            'url' => 'required|string|max:255'
        ]);

        try {   
                // Add publication to DB if does not exist
                $publication = Publication::firstOrCreate(['name' => $validated['publication']]);

                // Check if article already exists
                $article = ArticlesViewed::where('title', $validated['title'])
                                        ->where('publication_id', $publication->id)
                                        ->first();
        
                if($article) {

                    $article->increment('views');

                    return response()->json(['success' => 'article count increased']);
                }
        
                else {
                    ArticlesViewed::create([
                                    'title' => $validated['title'],
                                    'views' => 1,
                                    'publication_id' => $publication->id,
                                    'url'=> $validated['url']]);

                    return response()->json(['success' => 'article added']);
                }
        } 

        catch(Exception $e) {
            Log::error("DB query error on ArticlesViewed store(): {$e}");

            return response()->json(['error' => 'article could not be added']);
        }
    }
}
