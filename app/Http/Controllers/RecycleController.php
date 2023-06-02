<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecycleController extends Controller
{
    protected $empresa = "DIGITALTEI";
    public function employees()
    {
        $titulo = "Papelera de empleados";
        $empresa = $this->nameEmpresa();
        return view('employee.recycle',compact('titulo','empresa'));
    }
    public function contract()
    {
        $titulo = "Papelera de contratos";
        $empresa = $this->nameEmpresa();
        return view('contract.recycle',compact('titulo','empresa'));
    }
}
