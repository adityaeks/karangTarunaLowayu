<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $table = 'pengaduans';

    // Field yang diizinkan untuk mass assignment
    protected $fillable = [
        'name',
        'number',
        'content',
        'bukti_pengaduan',
    ];

    // Cast dates to Carbon with timezone
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
