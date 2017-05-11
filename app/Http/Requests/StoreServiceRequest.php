<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'tube_id' => 'required|exists:tubes,id',
            'jumlah_barang' => 'required|numeric',
            'nama_barang' => 'required|max:255',
            'keluhan' => 'required|max:255',
            'perkiraan_biaya' => 'required|numeric',
            'perkiraan_selesai' => 'required|date'            
        ];
    }
}
