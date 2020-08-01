<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookItem extends Model
{
    protected $fillable = [
        'id',
        'book_id',
        'number',
        'status',
        'note',
    ];
}
