<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuantityRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update as needed to check user permissions
    }

    public function rules()
    {
        return [
            'quantity' => 'required|integer',
        ];
    }
}
