<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_accounts',
            'password' => 'required|string|min:5|confirmed',
            'address' => 'required|string|max:255',
            'mobile_number' => 'required|string|min:11',
        ];
    }
}
