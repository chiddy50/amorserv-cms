<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'tag_id'
    ];
}
