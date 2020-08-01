<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    protected $fillable = [
        'id',
        'bookItem_id',
        'borrower_id',
        'librarian_id',
        'from_date',
        'to_date',
        'status',
        'date_of_return',
        'fine',
        'paid',
        'note',
    ];
}
