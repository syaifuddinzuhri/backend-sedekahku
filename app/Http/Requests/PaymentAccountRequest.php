<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentAccountRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
        ];


        if ($this->isMethod('POST')) {
            $rules['logo'] = 'required';
        } else {
            $rules['logo'] = 'nullable';
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'name.required' => 'Nama bank harus diisi.',
            'account_name.required' => 'Nama akun rekening harus diisi.',
            'account_number.required' => 'Nomor rekening harus diisi.',
            'name.required' => 'Nama harus diisi.',
            'logo.required' => 'Logo harus diisi.',
        ];
    }
}
