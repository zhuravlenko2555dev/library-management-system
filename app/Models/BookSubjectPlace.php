<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookSubjectPlace extends Model
{
    protected $fillable = [
        'book_id',
        'subjectPlace_id',
    ];
    public $timestamps = false;
}
