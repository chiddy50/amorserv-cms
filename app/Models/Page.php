<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'slug',
        'content',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'published_by',
        'is_published',
        'publish_date',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'page_tags', 'page_id', 'tag_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'page_categories', 'page_id', 'category_id');
    }
}
