<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'category' => 'required',
            'title' => 'required',
            'status' => 'required',
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
            'category.required' => 'Kategori harus diisi.',
            'title.required' => 'Judul harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'status.required' => 'Status harus diisi.',
            'image.required' => 'Gambar harus diisi.',
        ];
    }
}
