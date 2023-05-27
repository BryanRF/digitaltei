<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecycleController extends Controller
{
    protected $empresa = "DIGITALTEI";
    public function employees()
    {
        $titulo = "Papelera de empleados";
        $empresa = $this->empresa;
        return view('employee.recycle',compact('titulo','empresa'));
    }
}
