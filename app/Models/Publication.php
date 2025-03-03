<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class publication extends Model
{
    use HasFactory;
    //

    protected $fillable = [
        'name',
        'country'
    ];

    public $timestamps = false; 
}

