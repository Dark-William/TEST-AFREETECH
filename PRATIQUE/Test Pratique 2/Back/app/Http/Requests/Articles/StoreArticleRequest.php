<?php

namespace App\Http\Requests\Articles;

use Illuminate\Foundation\Http\FormRequest;
use App\Classes\ApiResponse;

class StoreArticleRequest extends FormRequest
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
            'name' => 'required|string|max:200',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'name.string' => 'The name must be a string',
            'name.max' => 'The name must not be greater than 200 characters',
            'price.required' => 'A price is required',
            'price.numeric' => 'The price must be a number',
            'description.string' => 'The description must be a string',
            'category_id.required' => 'A category is required',
            'category_id.exists' => 'The selected category is invalid',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException(
            $validator,
            ApiResponse::ApiResponse(null, $validator->errors(), 'Validation error', 422)
        );
    }

    
}
