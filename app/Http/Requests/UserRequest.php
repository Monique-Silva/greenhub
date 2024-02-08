<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
        return [
            'user_name' => ['required', 'string', 'max:15'],
            'first_name' => ['required', 'string', 'max:15'],
            'last_name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'email', 'max: 255', 'unique:users'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->uncompromised(),
            ],
            'role' => ['required', 'string', 'max:10'],
        ];
    }
}
