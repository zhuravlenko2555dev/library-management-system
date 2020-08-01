<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookLanguage extends Model
{
    protected $fillable = [
        'book_id',
        'language_id',
    ];
    public $timestamps = false;
}
