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
        $empresa = $this->nameEmpresa();
        return view('employee.index',compact('titulo','empresa'));
    }
  
  
    public function edit(Employee $employee)
    {
        
        $jobs = Job::all();
        $titulo = "Editar empleado";
        $empresa = $this->nameEmpresa();
        return view('employee.edit',compact('employee','jobs','titulo','empresa'));
    }
    public function create()
    {
        
        $jobs = Job::all();
        $data[]=null;
        $titulo = "Nuevo empleado";
        $empresa = $this->nameEmpresa();
        return view('employee.create',compact('titulo','jobs','empresa','data'));
    }
    public function showbydni($dni)
    {
        
       
        try {
            $employee = Employee::where('document', $dni)->firstOrFail();
            // Hacer algo con el empleado encontrado
            return response()->json($employee);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Manejar el caso cuando no se encuentra un empleado con el DNI proporcionado
            return response()->json(['error' => 'Empleado no encontrado']);
        }
    }
    public function store(StoreEmployee $request)
{
    $data = $request->all();

    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $filename = Str::random(20) . '.' . $avatar->getClientOriginalExtension();

        $imgFile = Image::make($avatar->getRealPath());
        $ruta = 'public/images/' . $filename;

        $imgFile->resize(400, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path('app/' . $ruta));

        $data['avatar'] = $ruta;
    } 

    if ($request->hasFile('file')) {
        $document = $request->file('file');
        $filename = 'doc-info-' . $data['lastname'] . '-' . $data['name'] . '-' . $data['document'] . '.' . $document->getClientOriginalExtension();

        $ruta = 'public/documents/' . $filename;

        Storage::disk('public')->putFileAs('documents', $document, $filename);

        $data['file'] = $ruta;
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
            $filename = Str::random(20) . '.' . $avatar->getClientOriginalExtension();
    
            $imgFile = Image::make($avatar->getRealPath());
            $ruta = 'public/images/' . $filename;
    
            $imgFile->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/' . $ruta));
    
            // Elimina el "/public" de la ruta para que coincida con la ruta deseada
            $data['avatar'] = Str::replaceFirst('public/', '', $ruta);
        } else {
            $data['avatar'] = $employee->avatar;
        }
    
        if ($request->hasFile('file')) {
            $document = $request->file('file');
            $filename = 'doc-info-' . $data['lastname'] . '-' . $data['name'] . '-' . $data['document'] . '.' . $document->getClientOriginalExtension();
    
            $ruta = 'public/documents/' . $filename;
    
            Storage::putFileAs('app/' . $ruta, $document, $filename);
    
            // Elimina el "/public" de la ruta para que coincida con la ruta deseada
            $data['file'] = Str::replaceFirst('public/', '', $ruta);
        } else {
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

    public function restored($id)
    {
        
        $empleado = Employee::withTrashed()->find($id); // find the soft deleted user by id
        $name = $empleado->name . ' '.$empleado->lastname;
        $empleado->update(['deleted_at' => null]); // restore the user
        // $empleado->restore();
        
        return response()->json(['message' => $name]);
    }

    public function destroy($id)
    {
        
        $empleado = Employee::find($id);
        $name = $empleado->name . ' '.$empleado->lastname;
        $empleado->delete();
        return response()->json(['message' => $name]);

    }
    public function show($id)
    {
        
        $empleado = Employee::find($id);
 

    }
}

