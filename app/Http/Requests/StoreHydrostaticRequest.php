<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHydrostaticRequest extends FormRequest
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
            'formujiriksa_id' => 'required|exists:formujiriksas,id',
            'tekanan_kerja' => 'required|numeric',
            'tekanan_pemadatan' => 'required|numeric',
            'pabrik_pembuat_tabung' => 'required|max:255',
            'pabrik_pemakai_tabung' => 'required|max:255',
            'berat_tercatat' => 'required|numeric',
            'berat_sekarang' => 'required|numeric',
            'selisih-' => 'required|numeric',
            'selisih+' => 'required|numeric',
            'selisih%' => 'required|numeric',
            'air_dipadatkan' => 'required|numeric',
            'pemuaian_tetap_cm3' => 'required|numeric',
            'pemuaian_tetap_%' => 'required|numeric',
            'suara_pukulan' => 'required|max:255',
            'keadaan_karat' => 'required|max:255',
            'keadaan_luar' => 'required|max:255',
            'masa_berpori' => 'required|max:255',
            'tanggal_uji' => 'required|date',
            'keterangan' => 'required|max:255',
            
        ];
    }
}
