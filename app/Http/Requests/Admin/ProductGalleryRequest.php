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
            'photos' => 'required|image|max:5000',
            'products_id' => 'required|exists:products,id'
        ];
    }

    public function messages()
    {
        return [
            'photos.required' => 'File harus dilampirkan',
            'photos.image' => 'File foto harus berekstensi jpg atau png',
            'photos.max' => 'Ukuran file foto maksimal 5MB',
            'products_id.required' => 'Produk harus dipilih',
        ];
    }
}
