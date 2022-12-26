<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article_Author extends Model
{
    public $timestamps = false;
    protected $table = 'article_author';
    //use HasFactory;
    protected $fillable = [
        'author_id', 'article_id'
    ];
}
