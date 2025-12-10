<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'number_of_tickets' => 'required|integer|min:1',
        ];
    }
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $event = $this->route('event');
            $requestedTickets = $this->input('number_of_tickets');

            if (!$event->hasAvailableTickets($requestedTickets)) {
                $validator->errors()->add(
                    'number_of_tickets',
                    "Only {$event->available_tickets} ticket(s) available."
                );
            }
        });
    }
}
