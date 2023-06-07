<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): Response
    {

        $employee = Employee::where('document', $request->document)->first();
      if ($employee) {
          $user = new User();
          $user->email= $request->email;
          $user->name= $employee->name.' '.$employee->lastname;
        //   $user->password= Hash::make($request->password);
          $user->password= ($request->password);
          $user->employee_id = $employee->id;
          $user->user_type_id = 1;
          $user->save();
          event(new Registered($user));
          Auth::login($user);
          return redirect()->route('home');
      }

        return response()->noContent();
    }
}
