<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     public  function __invoke(){

        $titulo = "Recuperar contraseña";
        $empresa = $this->nameEmpresa();
        return view ('auth.forgot-password',compact('titulo','empresa'));
    
       }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'El correo electrónico no está asociado a ningún usuario registrado.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        $titulo = "Recuperar contraseña";
        $empresa = $this->nameEmpresa();
        return redirect()->route('auth.forgot-password',compact('titulo','empresa'))->with('status' , __($status));
        // return view ('auth.forgot-password',compact('titulo','empresa')->response()->json(['status' => __($status)]));
        // return response()->json(['status' => __($status)]);
    }
}
