<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Publication;
use App\Models\ArticlesViewed;
use App\Models\Bookmark;

class AdminDataService {

        // Fetch and order articles by popularity
        public function articles_pop () {

           return ArticlesViewed::select(['title', 'views', 'url', 'publication_id'])
                                          ->with(['publication:id,name'])
                                          ->orderBy('views', 'desc')
                                          ->paginate(10)
                                          // Specify path URL to be returned
                                          ->withPath('/admin/data/articles');
        }

        // Fetch and order publications by popularity
        public function publications_pop () {

            return Publication::select('publications.id', 'publications.name', 
                    DB::raw('SUM(articles_viewed.views) as views'))
                    ->join('articles_viewed', 'articles_viewed.publication_id', '=', 'publications.id')
                    ->groupBy('publications.id', 'publications.name')
                    ->orderByDesc('views')
                    ->paginate(10)
                    ->withPath('/admin/data/publications');

        }

        // Fetch and order bookmarks by popularity
        public function bookmarks_pop () {
                
            return Bookmark::select(['title', 'count', 'publication_id'])
                            ->with(['publication:id,name'])
                            ->orderBy('count', 'desc')
                            ->paginate(10)
                            ->withPath('/admin/data/bookmarks');
        }

        // Return all of the data using tbe methods above
        public function all_data () {
            return [
                    'articles' => $this->articles_pop(),
                    'publications' => $this->publications_pop(),
                    'bookmarks' => $this->bookmarks_pop()
                    ];
        }
}