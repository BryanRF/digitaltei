<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class HomeController extends Controller
{
    public function __invoke()
    {
        $this->LoginStatus();
        $titulo = "Inicio";
        $empresa = "DIGITALTEI";
        $task = Task::orderBy('start_date', 'DESC')->get();

        return view('Home',compact('titulo','empresa','task'));
    }
}
