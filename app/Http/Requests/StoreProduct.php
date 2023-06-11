<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'presentation' => 'nullable',
            'brand_id' => 'required|exists:brands,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'brand_id.required' => 'La marca es obligatoria.',
            'brand_id.exists' => 'La marca seleccionada no es válida.',
            'subcategory_id.required' => 'La subcategoría es obligatoria.',
            'subcategory_id.exists' => 'La subcategoría seleccionada no es válida.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'El archivo debe tener uno de los siguientes formatos: JPEG, PNG, JPG o GIF.',
            'image.max' => 'El tamaño máximo del archivo es 2MB.',
        ];
    }

}
