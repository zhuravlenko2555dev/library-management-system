<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'id',
        'recipient_id',
        'type',
        'text',
        'is_seen',
    ];
}
