<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BhopApplicationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'church' => 'required|string|max:255',
            'team_volunteering_to' => 'required|string|max:255',
            'want_to_be_part_of_team' => 'required|boolean',
            'reason' => 'required|string|max:5000',
        ];
    }
}
