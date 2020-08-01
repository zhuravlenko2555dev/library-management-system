<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookPublisher extends Model
{
    protected $fillable = [
        'book_id',
        'publisher_id',
    ];
    public $timestamps = false;
}
