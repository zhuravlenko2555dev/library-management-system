<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'id',
        'faculty_id',
        'name',
    ];
    public $timestamps = false;
}
