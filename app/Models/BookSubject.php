<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookSubject extends Model
{
    protected $fillable = [
        'book_id',
        'subject_id',
    ];
    public $timestamps = false;
}
