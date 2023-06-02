<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Task;
class HomeController extends Controller
{
    public function __invoke()
    {
        
        $titulo = "Inicio";
        $empresa = "DIGITALTEI";
        $task = Task::orderBy('start_date', 'DESC')->get();
       
        return view('Home',compact('titulo','empresa','task'));
    }
}
