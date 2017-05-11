<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHydrostaticRequest extends StoreHydrostaticRequest
{
    public function rules()
    {
        $rules = parent::rules();
        return $rules;
    }
}
