<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infoarticle extends Model
{
    public $timestamps = false;
    protected $table = 'infoarticle';
    //use HasFactory;
    protected $fillable = [
        'id', 'inforelease_id','name','source','edition','recieptdate','additionalinfo','file_id'
    ];
}
