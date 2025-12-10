<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,

            'first_name'  => $this->first_name,
            'last_name'   => $this->last_name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'image'       => $this->image,

            'tickets' => [
                'max_tickets' => $this->max_tickets,
                'available_tickets' => $this->available_tickets,
                'registered_tickets' => $this->registrations()->sum('number_of_tickets'),
            ],

            'starts_at'   => $this->starts_at,
            'ends_at'     => $this->ends_at,
            'status'      => $this->status,
            'event_type'  => $this->event_type,

            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
