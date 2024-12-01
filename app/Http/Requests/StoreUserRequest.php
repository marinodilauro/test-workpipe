<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required|min:3|max:150',
            'last_name' => 'required|min:3|max:150',
            'email' => [
                'required',
                'min:5',
                'max:150',
            ],
            'date_of_birth' => [
                'required',
                'date',
                'after_or_equal:1900-01-01',
            ]
        ];
    }
}
