<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $timestamps = false;
    protected $table = 'author';
    //use HasFactory;
    protected $fillable = [
        'id', 'surname', 'name', 'middlename'
    ];
    public function books()
    {
        return $this->belongsToMany(Books::class, 'book_author');
    }
    public function authors()
    {
        return $this->belongsToMany(Article::class, 'article_author');
    }
}
