<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inforelease extends Model
{
    public $timestamps = false;
    protected $table = 'inforelease';
    //use HasFactory;
    protected $fillable = [
        'id', 'name','number','numbersk','publishyear','rubric_id'
    ];
}
