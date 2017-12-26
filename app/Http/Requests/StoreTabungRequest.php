<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTabungRequest extends FormRequest
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
            'no_tabung' => 'required|unique:tubes,no_tabung|max:255',
            'customer_id' => 'required|exists:customers,id',
            'warna_tabung' => 'required|max:255',
            'isi_tabung' => 'required|max:255',
            'tanggal_pembuatan' => 'required|date',
            'status' => 'required|max:255'
        ];
    }
}
