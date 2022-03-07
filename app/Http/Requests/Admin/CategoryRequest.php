<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string',
            'photo' => 'required|image|max:5120'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'photo.required' => 'Foto harus dilampirkan',
            'photo.image' => 'File harus berbentuk jpg atau png',
            'photo.max' => 'Ukuran maksimal file foto adalah 5 MB'
        ];
    }
}
