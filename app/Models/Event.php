<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',

        'first_name',
        'last_name',
        'email',
        'phone',

        'max_tickets',

        'starts_at',
        'ends_at',

        'status',
        'event_type',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
        'max_tickets' => 'integer',
    ];
}
