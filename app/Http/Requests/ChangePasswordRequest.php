<?php

namespace App\Http\Requests;

use App\Traits\GlobalTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class ChangePasswordRequest extends FormRequest
{
    use GlobalTrait;

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
            'old_password' => 'required|required|regex:/^(?=.*[a-z])(?=.*?[0-9])/',
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

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $msg = [];
        foreach ($errors as $field => $messages) {
            foreach ($messages as $message) {
                array_push($msg, $message);
            }
        }

        throw new HttpResponseException($this->customResponse(false, $msg));
    }
}
