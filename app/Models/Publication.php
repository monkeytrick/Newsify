<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ArticlesViewed;

class publication extends Model
{
    use HasFactory;
    //

    protected $fillable = [
        'name',
        'country'
    ];

    public $timestamps = false; 

    public function articlesViewed(): HasMany {

        return $this->HasMany(ArticlesViewed::class, 'publication_id');
    }
}

