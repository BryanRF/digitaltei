<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
   public  function showEmployee(){
    return view ('auth.register');
   }
   public  function showCustomer(){
    return view ('auth.register');

   }
   public function registerEmployee(RegisterRequest $request ){

   }
   public function registerCustomer(RegisterRequest $request ){

   }
}
