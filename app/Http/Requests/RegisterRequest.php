<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'user_types_id' => 'required|exists:user_types,id',
            'employees_id' => 'nullable|exists:employees,id',
            'customers_id' => 'nullable|exists:customers,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe proporcionar una dirección de correo electrónico válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'user_types_id.required' => 'El tipo de usuario es obligatorio.',
            'user_types_id.exists' => 'El tipo de usuario seleccionado no es válido.',
            'employees_id.exists' => 'El ID de empleado seleccionado no es válido.',
            'customers_id.exists' => 'El ID de cliente seleccionado no es válido.',
        ];
    }
}
