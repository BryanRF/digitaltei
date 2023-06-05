<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    public  function __invoke(){
        
        $titulo = "Confirmar Email";
        $empresa = $this->nameEmpresa();
        return view ('auth.confirm-email',compact('titulo','empresa'));
       }
}
