<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostAPIRequest extends FormRequest
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
        if ($this->has('title')) {
            $rules['title'] = ['required', 'string', 'max:255'];
        }

        if ($this->has('content')) {
            $rules['content'] = ['required', 'string'];
        }

        if ($this->has('author')) {
            $rules['author'] = ['required', 'string', 'max:255'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'title.string' => 'The title is string.',
            'content.required' => 'The content is required.',
            'content.string' => 'The content is string.',
            'username.required' => 'The username is required.',
            'username.max' => 'The username may not be greater than 255 characters.',
            'username.string' => 'The username is string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
