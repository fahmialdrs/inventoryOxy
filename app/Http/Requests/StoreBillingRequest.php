<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'tanggal_invoice' => 'required|date',
            'perihal' => 'required|max:255',
            'subtotal' => 'required|numeric',
            'ongkir' => 'required|numeric',
            'discount' => 'required|numeric',
            'ppn' => 'required|numeric',
            'total' => 'required|numeric',
            'terbilang' => 'required|max:255'
        ];
    }
}
