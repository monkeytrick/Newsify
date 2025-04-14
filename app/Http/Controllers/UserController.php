<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\NewsAPIService;
use App\Models\publication;
use App\Models\UserBookmark;
use App\Models\Bookmark;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;


// Handles routes logged-in users

class UserController extends Controller
{   
    // Latest news
    public function index(NewsAPIService $newsAPI) {

        $data = $newsAPI->headlines();

        return Inertia::render('UserDashboard', ['title' => 'Latest News', 'data' => $data]);

    }
    // Show user bookmarks
    public function bookmarks(Request $request){

        $data = UserBookmark::where('user', $request->user()->id)
        //With() uses 'article' method created in model
                            ->with([
                                //publication_id links tables
                                    'article:id,title,url,urlToImg,publication_id',
                                    'article.publication:id,name'
                                    ])
                            ->get()
                            ->makeHidden(['user_id']);
        
        // Format data for front-end compatibility
        $data = ['articles' => $data->map(function($article){
                    return [
                        
                            'bookmarkId' => $article->id,
                            'articleId' => $article->article->id,
                            'title' => $article->article->title,
                            'url' => $article->article->url,
                            'urlToImage' => $article->article->urlToImg,
                            'source' => ['name' => $article->article->publication->name],
                            'bookmarked' => true
                            ];
                        })
                ];
                
        // Make format same as API, which allows to check for empty data on front-end
        $data['totalResults'] = count($data['articles']);
      
        return Inertia::render('UserDashboard', ['title' => 'Bookmarks', 'data' => $data]);

    }

    // Add bookmark to bookmarks table and user_bookmarks
    public function addBookmark(Request $request){

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publication' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'urlToImg' => 'required|string|max:255'
        ]);
        
        // Check if bookmark already exists in bookmarks table
        $bookmark_id = Bookmark::where('url', $validated['url'])->first();

        // If bookmark already exists, increment count on bookmark then add to users' bookmarks table
        if( $bookmark_id !== null ) {
            $bookmark_id->increment('count');

            // Add bookmark to table
            $bookmarkId = UserBookmark::create([
                'user' => $request->user()->id,
                'bookmark_id' => $bookmark_id->id
            ]);

            return response()->json(['bookmarkId' => $bookmarkId]);
        };

    // If bookmark does not exist
        // Get publication id, or create new entry if publication not already in table.
        // Returns new id if newly created
        $publication = Publication::firstOrCreate(['name' => $validated['publication']]);

        // Consider refactoring below as a single query as models are linked

        // Create bookmark in table
        $new_bookmark = Bookmark::create([
                                        'publication_id' => $publication->id,
                                        'title' => $validated['title'],
                                        'url' => $validated['url'],
                                        'urlToImg' => $validated['urlToImg'],
                                        'count' => 1
        ]);

        // Create entry in user_bookmarks table (junction table) and return new ID
        $bookmarkId = UserBookmark::create([
                            'user' => $request->user()->id,
                            'bookmark_id' => $new_bookmark->id
        ]);        

        return response()->json(['bookmarkId' => $bookmarkId]);


    }

    public function deleteBookmark(Request $request, $articleId, $bookmarkId) {

               // Log::info("URL is $url");
        // As multiple tables are altered, use transaction to rollback in event of error
        DB::beginTransaction();

        try {
            // Get bookmark ID for deleting in users_bookmark table
            $bookmark = Bookmark::find($articleId);

            // Log::info("Request is $request");

           // Delete from user_bookmarks table
            UserBookmark::where(['id' => $bookmarkId, 'user' => $request->user()->id])->delete();

            // Decrease count value on bookmarks table
            if($bookmark) {
                $bookmark->decrement('count', 1);
            }

            // Delete the bookmark if no longer used
            if($bookmark->count === 0) {
                $bookmark->delete();
            }

            DB::commit();

            return response()->json(["success" => "Bookmark deleted"]);
        }
        catch(\Exception $e) {
            DB::rollBack();
            Log::error("Error deleting user bookmark: $e");
            return response()->json(["error" => "Error: Bookmark could not be deleted"]);
        } 

        // Delete user bookmark
            // find article in table with url
            // decrease counter
            // get article ID
            // Delete from user bookmarks tables

    }
}
