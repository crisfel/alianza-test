<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'lastName' => 'required|string',
            'phone' => 'required|string|max:10',
            'identification' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'department' => 'required|string',
            'email' => 'string',
            'password' => 'string',
            'role' => 'string',
            'boosID' => 'numeric'
        ];
    }
}
