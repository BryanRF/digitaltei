<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployee;
use App\Http\Requests\UpdateEmployee;
use App\Models\Employee;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
class EmployeeController extends Controller
{

    protected $empresa = "DIGITALTEI";
    public function index()
    {
        $titulo = "Gestion de empleados";
        $empresa = $this->empresa;
        return view('employee.index',compact('titulo','empresa'));
    }
    public function restore()
    {
        $empleado = Employee::find($id);
        $name = $empleado->name . ' '.$empleado->lastname;
        $empleado->delete();
    
        // return response()->json(['message' => $id]);
        return response()->json(['message' => $name]);
    }
  
    public function edit(Employee $employee)
    {
        $jobs = Job::all();
        $titulo = "Editar empleado";
        $empresa = $this->empresa;
        return view('employee.edit',compact('employee','jobs','titulo','empresa'));
    }
    public function create()
    {
        $jobs = Job::all();
        $data[]=null;
        $titulo = "Nuevo empleado";
        $empresa = $this->empresa;
        return view('employee.create',compact('titulo','jobs','empresa','data'));
    }
    
    public function store(StoreEmployee $request)
    {
        $success=null;
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = Str::random(20)  .'.' .$avatar->getClientOriginalExtension();
            $imgFile = Image::make($avatar->getRealPath());
            $ruta= storage_path().'\app\public\images/'.$filename;
            $imgFile->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($ruta);
            $data['avatar'] = 'images/'.$filename;
        } 
        else {
            $data['avatar'] = 'images/default.png';
        }
        if ($request->hasFile('file')) {
            $document = $request->file('file');
            $filename = 'doc-info-'.$data['lastname'].'-'.$data['name'].'-'.$data['document'] .'.' .$document->getClientOriginalExtension();
            $ruta = storage_path('app/public/documents/'.$filename);
            $document->move(storage_path('app/public/documents'), $filename);
            $data['file'] = 'documents/'.$filename;
        }
        if (Employee::create($data)) {
            $success="Empleado registrado.";
            return redirect()->route('employee.index')->with('success', $success);
        } else {
            unlink($ruta);
            return redirect()->back()->with('error', 'No se pudo registrar el registro.');
        }
    }
    public function update(UpdateEmployee $request, Employee $employee)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = Str::random(20)  .'.' .$avatar->getClientOriginalExtension();
            $imgFile = Image::make($avatar->getRealPath());
            $ruta= storage_path().'\app\public\images/'.$filename;
            $imgFile->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($ruta);
            $data['avatar'] = 'images/'.$filename;
        } 
        else {
            $data['avatar'] = $employee->avatar;
        }
        if ($request->hasFile('file')) {
            $document = $request->file('file');
            $filename = 'doc-info-'.$data['lastname'].'-'.$data['name'].'-'.$data['document'] .'.' .$document->getClientOriginalExtension();
            $ruta = storage_path('app/public/documents/'.$filename);
            $document->move(storage_path('app/public/documents'), $filename);
            $data['file'] = 'documents/'.$filename;
        }else{
            $data['file'] = $employee->file;
        }
        
        
        if ($employee->update($data)) {
            $success="Empleado actualizado.";
            return redirect()->route('employee.index')->with('success', $success);
        } else {
            unlink($ruta);
            return redirect()->back()->with('error', 'No se pudo actualizar el registro.');
        }
    }

    public function destroy($id)
    {
        $empleado = Employee::find($id);
        $name = $empleado->name . ' '.$empleado->lastname;
        $empleado->delete();
        // return response()->json(['message' => $id]);
        return response()->json(['message' => $name]);

    }
    public function show($id)
    {
        $empleado = Employee::find($id);
 

    }
}

