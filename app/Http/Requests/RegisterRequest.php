<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'document' => [
                'required',
                Rule::exists('employees')->where(function ($query) {
                    $query->where('document', $this->document)
                        ->whereNotNull('job_id'); // Verifica que el empleado esté registrado y tenga un job asignado
                }),
            ],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'document.required' => 'El DNI es obligatorio.',
            'document.exists' => 'El empleado no existe o no tiene acceso.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El email ingresado ya está registrado.',
            'password.required' => 'la contraseña es obligatorio.',
            'password.min' => 'la contraseña debe tener al menos 8 caracteres.',
            'password_confirmation.required' => 'El confirmar contraseña es obligatorio.',
            'password_confirmation.same' => 'La confirmación no coincide con la contraseña ingresada.',
        ];
        
        
    }
}
