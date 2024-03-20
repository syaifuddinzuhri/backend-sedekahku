<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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

    public function rules()
    {
        return [
            // 'old_password' => 'required|required|regex:/^(?=.*[a-z])(?=.*?[0-9])/',
            'password' => 'required|confirmed|required|regex:/^(?=.*[a-z])(?=.*?[0-9])/',
        ];
    }


    public function messages()
    {
        return [
            'old_password.regex' => 'Password lama harus kombinasi huruf dan angka',
            'old_password.required' => 'Password lama harus diisi',
            'password.required' => 'Password baru harus diisi',
            'password.regex' => 'Password baru harus kombinasi huruf dan angka',
            'password.confirmed' => 'Konfirmasi password baru tidak valid',
        ];
    }

}
