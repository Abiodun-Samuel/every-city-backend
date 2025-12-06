<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'full_name',
        'email',
        'phone_number',
        'subject',
        'message',
        'address',
        'type_of_prayer',
        'prayer_request',
        'location',
        'church',
        'team_volunteering_to',
        'want_to_be_part_of_team',
        'reason',
        'content',
        'status',
    ];

    protected $casts = [
        'want_to_be_part_of_team' => 'boolean',
    ];
    // Scopes
    public function scopeContact($query)
    {
        return $query->where('type', 'contact');
    }

    public function scopePrayer($query)
    {
        return $query->where('type', 'prayer');
    }

    public function scopeBhopApplication($query)
    {
        return $query->where('type', 'bhop_application');
    }

    public function scopeMailList($query)
    {
        return $query->where('type', 'mail_list');
    }
}
