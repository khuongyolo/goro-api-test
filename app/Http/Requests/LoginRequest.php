<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'regex:/^[a-zA-Z0-9.!#$%&\'"*+\/=?^_\`{|}~-]+@/', 'email:rfc'],
            'password' => ['required'],
        ];

    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email is required.',
            'email.regex' => 'The email format is invalid.',
            'email.email' => 'The email format is invalid.',
            'password.required' => 'The password is required.'
        ];
    }

}
