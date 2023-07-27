<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'published_by',
        'is_published',
        'publish_date'
    ];

    protected $appends = [
        'author'
    ];

    public function getAuthorAttribute()
    {
        if ($this->is_published) {
            return User::where('id', $this->is_published)->select('name')->first();
        }
        return $this->is_published;
    }
}
