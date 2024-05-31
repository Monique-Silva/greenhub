<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'number' => ['required', 'numeric'],
            'road' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'integer'],
            'city' => ['required', 'string', 'max:15'],
            'country' => ['required', 'string', 'max:20'],
            'user_id' => ['required', 'exists:App\Models\User,id'],
        ];
    }
}
