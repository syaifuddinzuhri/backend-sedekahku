<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'phone' => ['required', 'numeric', 'regex:/(0)[0-9]{9}/', Rule::unique('users', 'phone')],
            'email' => ['email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|regex:/^(?=.*[a-z])(?=.*?[0-9])/',
            'province_id' => 'required',
            'city_id' => 'required',
            'subdistrict_id' => 'required',
            'village_id' => 'required',
            'address' => 'required',
            'supplier_id' => 'required_if:role,supplier|required_if:role,customer',
            // 'market_id' => 'required_if:role,customer',
            'role' => 'required',
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
            'province_id.required' => 'Provinsi harus diisi',
            'city_id.required' => 'Kota/Kabupaten harus diisi',
            'subdistrict_id.required' => 'Kecamatan harus diisi',
            'village_id.required' => 'Desa/kelurahan harus diisi',
            'address.required' => 'Alamat harus diisi',
            'role.required' => 'Role harus diisi',
            'supplier_id.required_if' => 'Supplier harus diisi',
            'market_id.required_if' => 'Pasar harus diisi',
        ];
    }
}
