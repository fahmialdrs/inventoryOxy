<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBillingRequest extends StoreBillingRequest
{
    public function rules()
    {
        $rules = parent::rules();
        return $rules;
    }
}
