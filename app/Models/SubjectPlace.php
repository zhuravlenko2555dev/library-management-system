<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectPlace extends Model
{
    protected $fillable = [
        'id',
        'alias',
        'name',
    ];
    public $timestamps = false;
}
