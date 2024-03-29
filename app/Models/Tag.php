<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_tags', 'tag_id', 'page_id');
    }
}
