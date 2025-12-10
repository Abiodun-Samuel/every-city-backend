<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',

        'first_name',
        'last_name',
        'email',
        'phone',

        'image',

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

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function getAvailableTicketsAttribute(): int
    {
        $registered = $this->registrations()->sum('number_of_tickets');
        return max(0, $this->max_tickets - $registered);
    }

    public function hasAvailableTickets(int $requestedTickets): bool
    {
        return $this->available_tickets >= $requestedTickets;
    }
}
