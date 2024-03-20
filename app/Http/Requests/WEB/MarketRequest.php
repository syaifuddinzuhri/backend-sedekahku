<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;

class MarketRequest extends FormRequest
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
            'name' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'subdistrict_id' => 'required',
            'village_id' => 'required',
            'address' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'province_id.required' => 'Provinsi harus diisi',
            'city_id.required' => 'Kota/Kabupaten harus diisi',
            'subdistrict_id.required' => 'Kecamatan harus diisi',
            'village_id.required' => 'Desa/kelurahan harus diisi',
            'address.required' => 'Alamat harus diisi',
        ];
    }
}
