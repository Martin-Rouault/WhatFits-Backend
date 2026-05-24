<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBuildRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'car_model_id' => ['required', 'integer', 'exists:car_models,id'],
            'wheel_id'     => ['required', 'integer', 'exists:wheels,id'],
            'car_year'     => ['required', 'integer', 'min:1900', 'max:' . date('Y') + 1],
            'diameter'     => ['required', 'integer', 'min:13', 'max:24'],
            'width'        => ['required', 'numeric', 'decimal:1', 'min:5.0', 'max:15.0'],
            'photos'       => ['required', 'array', 'min:1', 'max:5'],
            'photos.*'     => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048']
        ];
    }
}
