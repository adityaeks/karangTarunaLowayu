<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Berita extends Model implements Viewable
{
    use HasFactory;
    use InteractsWithViews;

    // Field yang diizinkan untuk mass assignment
    protected $fillable = [
        'name',
        'photo',
        'content',
        'published_at',
        'slug',
        'category_id',
        'author_id',
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
