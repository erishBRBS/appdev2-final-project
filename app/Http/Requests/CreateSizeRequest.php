<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSizeRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update as needed to check user permissions
    }

    public function rules()
    {
        return [
            'size' => 'required|string|max:255',
        ];
    }
}
