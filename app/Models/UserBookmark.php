<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBookmark extends Model
{
    /** @use HasFactory<\Database\Factories\UserBookmarkFactory> */
    use HasFactory;

    // Set mass-assignable values by not specifying any in $guarded
    // instead of assigning all in $fillable[]
    protected $guarded = [];

    public $timestamps = false;

    public function article(): BelongsTo {

        return $this->belongsTo(Bookmark::class, 'bookmark_id');

    }
}
