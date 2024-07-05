<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email field is required',
            'email.*' => 'Email field is invalid',
            'password.required' => 'Password field is required',
            'password.*' => 'Password field is invalid',
        ];
    }
}
