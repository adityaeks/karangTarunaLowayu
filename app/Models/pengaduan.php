<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengaduan extends Model
{
    use HasFactory;

    // Field yang diizinkan untuk mass assignment
    protected $fillable = [
        'name',
        'number',
        'content',
        'bukti_pengaduan',
    ];
}
