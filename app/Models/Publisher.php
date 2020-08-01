<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = [
        'id',
        'name',
        'address',
        'phone_number',
        'email',
    ];
    public $timestamps = false;
}
