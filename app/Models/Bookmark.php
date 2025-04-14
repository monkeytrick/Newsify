<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    // Set mass-assignable values by not specifying any in $guarded
    // instead of assigning all in $fillable[]
    protected $guarded = [];
    public $timestamps = false;

    function publication(): BelongsTo {
        return $this->belongsTo(publication::class, 'publication_id');
    }

}
