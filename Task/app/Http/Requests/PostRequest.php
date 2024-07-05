<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title field is required',
            'title.*' => 'Title field is invalid',
            'content.required' => 'Content field is required',
            'content.*' => 'Description field is invalid',
        ];
    }
}
