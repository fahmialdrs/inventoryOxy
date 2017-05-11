<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends StoreServiceRequest
{
    public function rules()
    {
        $rules = parent::rules();
        return $rules;
    }
}
