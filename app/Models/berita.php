<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Field yang diizinkan untuk mass assignment
    protected $fillable = [
        'name',
        'photo',
        'content',
        'published_at',
        'slug',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
