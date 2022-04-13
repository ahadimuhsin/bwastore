<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductGalleryRequest extends FormRequest
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
            'file' => 'required|image|max:5000',
            'id_produk' => 'required|exists:products,id'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'File harus dilampirkan',
            'file.image' => 'File foto harus berekstensi jpg atau png',
            'file.max' => 'Ukuran file foto maksimal 5MB',
            'id_produk.required' => 'Produk harus dipilih',
        ];
    }
}
