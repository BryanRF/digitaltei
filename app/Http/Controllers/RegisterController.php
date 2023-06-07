<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
// use Illuminate\Foundation\Auth\RegistersUsers;
class RegisterController extends Controller
{

   public  function showEmployee(){
      if(Auth::check()){
         return  redirect()->to(route('home'));
     }
     $titulo = "Registro";
     $empresa = $this->nameEmpresa();
     return view ('auth.register',compact('titulo','empresa'));
    }


   public function registerEmployee(RegisterRequest $request ){
      $employee = Employee::where('document', $request->document)->first();
      if ($employee) {
          $user = new User();
          $user->email= $request->email;
          $user->name= $employee->name.' '.$employee->lastname;
          $user->password= ($request->password);
          $user->employee_id = $employee->id;
          $user->user_type_id = 1;
          $user->save();
          Auth::login($user);
          event(new Registered($user));
          return redirect()->route('notification.comfirm');
      }
   }
  
  
   public  function showCustomer(){
      return view ('auth.register');
  
     }
}
