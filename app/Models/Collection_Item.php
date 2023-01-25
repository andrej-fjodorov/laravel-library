<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection_Item extends Model
{
    public $timestamps = false;
    protected $table = 'collection_item';
    //use HasFactory;
    protected $fillable = [
        'id', 'collection_id', 'lit_uuid'
    ];
}
