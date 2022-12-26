<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statrelease extends Model
{
    public $timestamps = false;
    protected $table = 'statrelease';
    //use HasFactory;
    protected $fillable = [
        'id', 'name','additionalname','response','publishplace','publishyear','pages','recieptdate','cost','code','authorsign','numbersk'
    ];
    public function statrelease()
    {
        return $this->hasOne(Statrelease::class);
    }
}
