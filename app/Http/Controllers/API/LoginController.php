<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Has;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function login(Request $request):JsonResponse
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            $message = [];
            
            if (!User::where('email', $credentials['email'])->exists()) {
                $message['email'] = 'El email ingresado no existe en nuestros registros.';
            } else {
                $message['password'] = 'La contraseña ingresada es incorrecta.';
            }
            $message['success'] =  false;
            $message['codigo']=401;
            return response()->json([$message]);
        }
        $user = User::where('email', $request->email)
        ->whereNotNull('employee_id')
        ->whereNull('customer_id')
        ->first();
        if ($user) {
            $employee = Employee::select('id', 'phone','avatar')
                ->where('id', $user->employee_id)
                ->first();
            $message['success'] =  false;
            $message['message'] =  'El usuario es empleado pero no cliente.';
            $message['user'] =  $user;
            $message['employee'] =  $employee;
            $message['codigo']=405;
        return response()->json([$message ]);
        }

    
        $user = Auth::user();
        Session::flush();
        Auth::logout();
            $message['success'] =  true;
            $message['message'] =  'Credenciales correctas.';
            $message['user'] =  $user;
            $message['token'] =  $user->createToken($user->email)->plainTextToken; 
            $message['codigo']=200;
        return response()->json([$message ]);
    }
   

    
}
