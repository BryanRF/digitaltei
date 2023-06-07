<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $empresa = "DIGITALTEI";
    public  function __invoke(){
        if(Auth::check()){
            return  redirect()->to(route('home'));
        }
        $titulo = "Login";
        $empresa = $this->nameEmpresa();
        return view ('auth.login',compact('titulo','empresa'));
       }

       public function loginEmployee(LoginRequest $request)
       {
           if (!Auth::attempt($request->only('email', 'password'))) {
               return redirect()->to(route('auth.login'))->withErrors(['auth' => 'Estas credenciales no coinciden con nuestros registros.']);
           }
       
           $user = Auth::getProvider()->retrieveByCredentials($request->only('email', 'password'));
           
           $isEmployee = User::where('id', auth()->user()->id)
           ->whereNotNull('employee_id')
           ->first();
       
       if (!$isEmployee) {
           Session::flush();
           Auth::logout();
       }
          
           return $this->authenticated($request, $user);
       }
      public function authenticated(Request $request,$user){
            return  redirect()->to(route('home'));

      }
   
      
}
