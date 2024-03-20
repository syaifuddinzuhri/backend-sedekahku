<?php

namespace App\Http\Requests;

use App\Traits\GlobalTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
            'phone' => ['required', 'numeric', 'regex:/(0)[0-9]{9}/'],
            'password' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'phone.required' => 'Nomor HP harus diisi',
            'password.required' => 'Password harus diisi',
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
