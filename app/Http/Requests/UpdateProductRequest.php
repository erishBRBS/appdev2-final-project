<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'brand_id' => 'sometimes|exists:item_brands,id',
            'product_name' => 'sometimes|string|max:255|unique:item_products,product_name,' . $this->route('id'),
            'size_id' => 'sometimes|exists:item_sizes,id',
            'price' => 'sometimes|numeric',
            'description' => 'sometimes|string',
            'quantity_id' => 'sometimes|exists:item_quantities,id',
        ];
    }
}
