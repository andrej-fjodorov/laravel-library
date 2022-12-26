<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = false;
    protected $table = 'article';
    //use HasFactory;    
    protected $fillable = [
        'id','name', 'pages','annotation', 'id'. 'issue_id','file_id'
    ];
}
