<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($this->route('product')->id),
            ],
            'slug' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('products', 'slug')->ignore($this->route('product')->id),
            ],
            'sku' => [
                'sometimes',
                'string',
                'max:100',
                Rule::unique('products', 'sku')->ignore($this->route('product')->id),
            ],
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|gt:price',
            'is_on_sale' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
            'image_url' => 'sometimes|image|max:2048',
            'quantity' => 'sometimes|integer|min:0',
            'subfamily_id' => 'sometimes|exists:subfamilies,id',
            'brand_id' => 'sometimes|exists:brands,id',

        ];
    }
}
