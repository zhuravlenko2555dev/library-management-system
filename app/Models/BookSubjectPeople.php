<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookSubjectPeople extends Model
{
    protected $fillable = [
        'book_id',
        'subjectPeople_id',
    ];
    public $timestamps = false;
}
