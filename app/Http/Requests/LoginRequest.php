<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
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
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Auth::attempt(['email' => request('email'), 'password' => $value])) {
                        $fail('La contraseña proporcionada es incorrecta.');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Debe proporcionar una dirección de correo electrónico válida.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.exists' => 'El correo electrónico ingresado no está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }

        
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $credentials = $this->only('email', 'password');
            
            if (!Auth::attempt($credentials)) {
                $validator->errors()->add('auth', 'Estas credenciales no coinciden con nuestros registros.');
            } else {
                $user = Auth::user();
                
                if (!$user->email_verified_at) {
                    $validator->errors()->add('auth', 'Tu correo electrónico no ha sido verificado.');
                }
            }
        });
    }

}
