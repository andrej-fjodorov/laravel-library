<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    public $timestamps = false;
    protected $table = 'issue';
    //use HasFactory;
    protected $fillable = [
        'id', 'journal_id','issuecode','issueyear','issuenumber','issuedate'
    ];
}
