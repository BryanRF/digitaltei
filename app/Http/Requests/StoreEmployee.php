<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
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
            'lastname' => 'required',
            'document' => 'required|unique:employees',
            'email' => 'required|unique:employees',
            'birthday_date' => 'required|date|before:today,18 years',
            'gender' => 'required',
            'phone' => 'required|unique:employees',
            'job_id' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'file' => 'nullable|mimes:pdf,doc,docx',

        ];
    }
    public function messages()
    {
        return [
            'name.required' =>'Debe ingresar sus nombres',
            'lastname.required' =>'Debe ingresar sus apellidos',
            'document.required '=>'Debe ingresar número de dni',
            'document.unique' =>'Este número de dni ya fue registrado',
            'email.required' =>'Debe ingresar un correo electrónico',
            'email.unique' =>'Este correo electrónico ya fue registrado',
            'birthday_date.required' =>'Debe ingresar fecha de nacimiento',
            'birthday_date.before' =>'Debe ser mayor de 18 años',
            'gender.required' =>'Debe seleccionar el género',
            'phone.required' =>'Debe ingresar un número de teléfono',
            'phone.unique' =>'Este número de teléfono ya fue registrado',
            'job_id.required'=>'Debe seleccionar el cargo',
            'avatar.image' =>'El archivo seleccionado no es una imagen',
            'avatar.mimes' =>'Solo se permiten los formatos jpeg,png,jpg,gif y svg',
            'file.mimes' => 'Solo se permiten los formatos PDF o Word (pdf, doc, docx).'
        ];
    }


}
