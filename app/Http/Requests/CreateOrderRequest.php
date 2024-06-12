<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update as needed to check user permissions
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:item_products,id',
        ];
    }
}
