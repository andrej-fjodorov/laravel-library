<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    public $timestamps = false;
    protected $table = 'book';
    //use HasFactory;    
    protected $fillable = [
        'id', 'name','additionalname','bookinfo','publishplace','publishyear','tom','pages','authorsign','code','numbersk','recieptdate','cost','ISBN','annotation','withraw','rubric_id','file_id'
    ];    
}
