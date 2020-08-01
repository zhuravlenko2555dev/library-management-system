<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservedBook extends Model
{
    protected $fillable = [
        'id',
        'book_id',
        'reserved_by',
    ];
}
