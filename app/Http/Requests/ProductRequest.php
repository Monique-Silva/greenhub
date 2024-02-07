<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required'],
            'price' => ['required'],
            'vat_rate' => ['required'],
            'stock' => ['required'],
            'description' => ['required'],
            'environmental_impact' => ['required'],
            'origin' => ['required'],
            'measuring_unit' => ['required'],
            'measure' => ['required'],
        ];
    }
    public function messages()
{
    return [
        'name.required' => 'The name field is required.',
        'price.required' => 'The email field is required.',
        'vat_rate.required' => 'The email field is required.',
        'stock.required' => 'The stock field is required.',
        'description.required' => 'Please, write a description.',
        'environmental_impact.required' => 'The environmental impact must be filled.',
        'origin.required' => 'The origin field is required.',
        'measuring_unit.required' => 'The measuring unit field is required.',
        'measure.required' => 'The measure field is required.',

        ];
}
}
