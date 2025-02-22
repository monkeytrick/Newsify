<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class ArticlesViewed extends Model
{
    //

    use HasFactory;
    
    protected $table = "articles_viewed";

    protected $fillable = [
        'title',
        'views',
        'url',
        'publication_id'
    ];

    public $timestamps = false;
}
