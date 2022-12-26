<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statreleaserubric extends Model
{
    public $timestamps = false;
    protected $table = 'statreleaserubric';
    // use HasFactory;
   protected $fillable = [
    'id', 'title'
];    
public function statreleaserubric()
   {
     return $this->hasOne(Statreleaserubric::class);
   }  
}
