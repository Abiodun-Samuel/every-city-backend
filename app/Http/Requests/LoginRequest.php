<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }

    public function authenticate()
    {
        // Check if email is in allowed list
        if (!User::isEmailAllowed($this->email)) {
            throw ValidationException::withMessages([
                'email' => ['You are not authorized to access this system.'],
            ]);
        }

        // Check credentials
        if (!auth()->attempt($this->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return auth()->user();
    }
}
