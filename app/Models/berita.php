<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    //
    use HasFactory;

    // Field yang diizinkan untuk mass assignment
    protected $fillable = [
        'name',
        'photo',
        'category',
        'content',
    ];

}
