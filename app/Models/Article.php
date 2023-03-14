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
    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
    public function files()
    {
        return $this->belongsTo(Files::class);
    }
    public function authors()
    {
        return $this->belongsToMany(Author::class,'article_author');
    }    
}
