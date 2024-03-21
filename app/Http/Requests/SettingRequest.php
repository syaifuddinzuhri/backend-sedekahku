<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'about' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'about.required' => 'Tentang harus diisi.',
            'email.required' => 'Email harus diisi.',
            'phone.required' => 'Nomor hp harus diisi.',
            'address.required' => 'Alamat harus diisi.',
        ];
    }
}
