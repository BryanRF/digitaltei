<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'email.email' => 'Debe proporcionar una dirección de correo electrónico válida.',
            'email.required' => 'El Correo electronico es obligatoria.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
    // public function getCredentials(){
    //     $username = $this->get('name');
    //     if($this->isEmail($username)){
    //         return[
    //             'email'=>$username,
    //             'password'=>$this->get('password')
    //         ];
    //     }
    //     return $this->only('name','password');

    // }
    // public function isEmail($value){
    //     $factory= $this->container->make(ValidationFactory::class);
    //     return ! $factory->make(['name'=>$value],['name'=>'email'])->fails();

    // }
}
