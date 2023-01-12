<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;
    protected $table = 'book';
    //use HasFactory;    
    protected $fillable = [
        'id', 'name','additionalname','bookinfo','publishplace','publishyear','tom','pages','authorsign','code','numbersk','recieptdate','cost','ISBN','annotation','withraw','rubric_id','file_id'
    ];
    public function authors()
    {
        return $this->belongsToMany(Author::class,'book_author');
    }
    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }
    public function files()
    {
        return $this->belongsTo(Files::class);
    }

}
