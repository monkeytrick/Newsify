<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlesViewed extends Model
{
    //
    protected $table = "articles_viewed";

    protected $fillable = [
        'title',
        'views',
        'url'
    ];

    public $timestamps = true;
}
