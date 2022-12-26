<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{   
    public $timestamps = false;
    
    protected $table = 'journal';
    //use HasFactory;
    protected $fillable = [
        'id', 'name', 'ISSN', 'rubric_id'
    ];
}
