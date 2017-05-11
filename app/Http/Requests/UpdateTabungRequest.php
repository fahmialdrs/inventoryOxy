<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTabungRequest extends StoreTabungRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['no_tabung'] = 'required|unique:tubes,no_tabung,' . $this->route('tabung');
        return $rules;
    }
}
