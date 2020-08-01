<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookItemShelf extends Model
{
    protected $fillable = [
        'bookItem_id',
        'shelf_id',
    ];
    public $timestamps = false;
}
