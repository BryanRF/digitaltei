<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


class EmailNotificationController extends Controller
{
    public  function __invoke(){
        $user = Auth::user();
        event(new Registered($user));
        $titulo = "Confirmacion Enviada";
        $empresa = $this->nameEmpresa();
        return view ('auth.email-sending',compact('titulo','empresa'));

       }
}
