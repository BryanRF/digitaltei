<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Auth;


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
