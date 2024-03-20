<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;


class BankRequest extends FormRequest
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
            $rules['icon'] = 'required';
        } else {
            $rules['icon'] = 'nullable';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Bank harus diisi.',
            'account_number.required' => 'Nomor rekening harus diisi.',
            'account_name.required' => 'Nama pemilik rekening harus diisi.',
            'icon.required' => 'Icon harus diisi.',
        ];
    }
}
