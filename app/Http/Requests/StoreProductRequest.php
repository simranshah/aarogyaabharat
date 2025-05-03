<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
                'name'                  => 'required|string|max:255',
                'category_id'           => 'required|exists:categories,id',
                'title'                 => 'nullable|string|max:255',
                'image.*'                 => 'nullable|max:2048',
                // 'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description'           => 'nullable|string',
                'features_specification' => 'nullable|string',
                'price'                 => 'required|numeric|min:0',
                'about_item'            => 'nullable|string',
                'weekly_price'          => 'nullable|numeric|min:0',  // Validation for weekly price
                // 'is_rentable'           => 'boolean',                // Checkbox for rentable product
                // 'is_popular'            => 'boolean',                // Checkbox for popular product
                // 'is_new'                => 'boolean', 
            ];
    }
}
