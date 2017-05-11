<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends StoreUserRequest
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['email'] = 'required|email|unique:users,email,' . $this->route('user');
        return $rules;
    }
}
