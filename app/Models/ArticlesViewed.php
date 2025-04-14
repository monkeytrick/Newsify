<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ArticlesViewed extends Model
{
    //

    use HasFactory;
    
    public $timestamps = false;

    protected $table = "articles_viewed";

    protected $fillable = [
        'title',
        'views',
        'url',
        'publication_id'
    ];

    public function publication (): BelongsTo {

        return $this->belongsTo(Publication::class, 'publication_id');
    }
    
}
