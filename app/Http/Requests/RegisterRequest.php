<?php

namespace App\Http\Requests;

use App\Traits\GlobalTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'phone' => ['required', 'numeric', 'regex:/(0)[0-9]{9}/', Rule::unique('users', 'phone')],
            'email' => ['email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|regex:/^(?=.*[a-z])(?=.*?[0-9])/',
            // 'market_id' => 'required',
            'supplier_id' => 'required',
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
            'phone.required' => 'Nomor HP harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.regex' => 'Password harus kombinasi huruf dan angka',
            'password.confirmed' => 'Konfirmasi password tidak valid',
            'supplier_id.required' => 'Supplier harus diisi',
            'market_id.required' => 'Pasar harus diisi',
            'province_id.required' => 'Provinsi harus diisi',
            'city_id.required' => 'Kota/Kabupaten harus diisi',
            'subdistrict_id.required' => 'Kecamatan harus diisi',
            'village_id.required' => 'Desa/kelurahan harus diisi',
            'address.required' => 'Alamat harus diisi',
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
