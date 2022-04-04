<?php

namespace App\Http\Requests\Admin;

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
        return [
            'name' =>  'required|string|max:255',
            'users_id' => 'required|exists:users,id',
            'categories_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'users_id.required' => 'User harus dipilih',
            'categories_id.required' => 'Kategori harus dipilih',
            'price.required' => 'Harga harus diisi',
            'description' => 'Deskripsi harus diisi'
        ];
    }
}
