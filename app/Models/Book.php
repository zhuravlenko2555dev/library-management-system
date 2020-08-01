<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'id',
        'olid',
        'isbn',
        'name',
        'publish_date',
        'number_of_pages',
        'description',
        'image_small',
        'image_medium',
        'image_large',
    ];
}
