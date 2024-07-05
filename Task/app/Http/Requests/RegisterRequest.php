<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required_with:password|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name field is required',
            'first_name.*' => 'First name field is invalid',
            'last_name.required' => 'Last name field is required',
            'last_name.*' => 'Last name field is invalid',
            'email.required' => 'Email field is required',
            'email.unique' => 'Email field is duplicated',
            'email.*' => 'Email field is invalid',
            'password.required' => 'Password field is required',
            'password.*' => 'Password field is invalid',
            'password_confirmation.required' => 'Password confirmation field is required',
            'password_confirmation.*' => 'Password confirmation field is invalid',
        ];
    }
}
