<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContract extends FormRequest
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
            'employee_id' => 'required',
            'job_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'file' => 'nullable|mimes:pdf,doc,docx',
            'description' => 'required',
            'salary' => 'required|numeric',
        ];
    }

    /**
     * Get the validation messages for the defined rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'employee_id.required' => 'Se requiere un empleado.',
            'job_id.required' => 'El cargo es requerido.',
            'start_date.required' => 'La fecha es obligatoria.',
            'start_date.date' => 'Debe ser una fecha válida.',
            'end_date.date' => 'Debe ser una fecha válida.',
            'description.required' => 'La descripción es obligatoria.',
            'salary.required' => 'El salario es obligatorio.',
            'salary.numeric' => 'El salario debe ser un número.',
            'file.mimes' => 'El archivo debe ser un archivo de tipo PDF, DOC o DOCX.',
        ];
    }
}
