<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookGenre extends Model
{
    protected $fillable = [
        'book_id',
        'genre_id',
    ];
    public $timestamps = false;
}
