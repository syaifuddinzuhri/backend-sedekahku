<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramRequest extends FormRequest
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
            'description' => 'required',
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
            'description.required' => 'Deskripsi harus diisi.',
            'name.required' => 'Nama harus diisi.',
            'image.required' => 'Thumbnail harus diisi.',
        ];
    }
}
