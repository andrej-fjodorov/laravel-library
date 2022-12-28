<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    public $timestamps = false;
    
    protected $table = 'rubric';
    // use HasFactory;
    protected $fillable = [
        'id', 'title','shottitle'
    ];
    public function books()
    {
        return $this->hasMany(Book::class);
       
    }
}
