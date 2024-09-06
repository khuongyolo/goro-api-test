<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [];
        if ($this->has('name')) {
            $rules['name'] = ['required', 'max:255'];
        }

        if ($this->has('email')) {
            $rules['email'] = ['required', 'regex:/^[a-zA-Z0-9.!#$%&\'"*+\/=?^_\`{|}~-]+@/', 'email:rfc', 'max:255'];
        }

        if ($this->has('password')) {
            $rules['password'] = ['nullable', 'regex:/^[a-zA-Z0-9]+$/', 'max:20', 'required_with:password_confirmation', 'same:password_confirmation'];
        }
        if ($this->has('password_confirmation')) {
            $rules['password_confirmation'] = ['nullable', 'required_with:password'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'name.max' => 'The name must not exceed 255 characters.',
            'email.required' => 'The email is required.',
            'email.regex' => 'The email format is invalid.',
            'email.email' => 'The email format is invalid.',
            'email.max' => 'The email must not exceed 255 characters.',
            '*.required_with' => 'Both password and password confirmation are required.',
            'password.regex' => 'The password format is invalid.',
            'password.max' => 'The password must not exceed 20 characters.',
            'password.same' => 'The password and password confirmation must match.',
            'password_confirmation.same' => 'The title is required.',

        ];
    }
}
