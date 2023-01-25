<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public $timestamps = false;
    protected $table = 'collection';
    //use HasFactory;
    protected $fillable = [
        'id', 'user_id', 'title'
    ];
}
