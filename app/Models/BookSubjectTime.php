<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookSubjectTime extends Model
{
    protected $fillable = [
        'book_id',
        'subjectTime_id',
    ];
    public $timestamps = false;
}
