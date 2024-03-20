<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'supplier_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'unit_id' => 'required',
            'price' => 'required',
            // 'stock' => 'required',
        ];


        if ($this->isMethod('POST')) {
            $rules['image'] = 'required';
        } else {
            $rules['image'] = 'nullable';
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'supplier_id.required' => 'Supplier harus diisi.',
            'name.required' => 'Nama harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'price.required' => 'Harga harus diisi.',
            'unit_id.required' => 'Unit harus diisi.',
            'stock.required' => 'Stok harus diisi.',
            'image.required' => 'Gambar harus diisi.',
        ];
    }
}
