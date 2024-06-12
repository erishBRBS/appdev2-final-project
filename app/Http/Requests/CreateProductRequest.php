<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'brand_id' => 'required|exists:item_brands,id',
            'product_name' => 'required|string|max:255|unique:item_products',
            'size_id' => 'required|exists:item_sizes,id',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'quantity_id' => 'required|exists:item_quantities,id',
        ];
    }
}
