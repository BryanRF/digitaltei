<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContract;
use App\Http\Requests\StoreEmployee;
use App\Http\Requests\UpdateContract;
use App\Http\Requests\UpdateEmployee;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $empresa = "DIGITALTEI";
    public function index()
    {
        $titulo = "Gestion de contratos";
        $empresa = $this->nameEmpresa();
        return view('contract.index',compact('titulo','empresa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::all();
        $titulo = "Nuevo contrato";
        $empresa = $this->nameEmpresa();
        return view('contract.create',compact('titulo','jobs','empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContract $request)
{
    $success = null;
    $data = $request->all();
    if ($request->hasFile('file')) {
        $document = $request->file('file');
        $filename = 'Contracto-'.$data['lastname'].'-'.$data['name'].'-'.$data['document'] .'-'.now().'.' .$document->getClientOriginalExtension();
        $document->move(storage_path('app/public/documents'), $filename);
        $data['file'] = 'documents/'.$filename;
    }
    try {
        if (Contract::create($data)) {
            $success = "Contrato registrado.";
            return redirect()->route('contract.index')->with('success', $success);
        }
    } catch (\Exception $e) {
        $error = $e->getMessage();
        return redirect()->back()->with('error', $error);
    }
    
    return redirect()->back()->with('error', 'No se pudo registrar el registro.');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $nombre = $employee->name. ' '.$employee->lastname;
        $titulo = "Contratos de ".$nombre;
        $empresa = $this->nameEmpresa();
        return view('contract.show',compact('titulo','empresa','employee'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        $jobs = Job::all();
        $titulo = "Editar contrato";
        $empresa = $this->nameEmpresa();
        $employee = Employee::find($contract->employee_id);
        return view('contract.edit',compact('contract','jobs','titulo','empresa','employee'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContract $request, Contract $contract)
    {
        $data = $request->all();
        
        if ($request->hasFile('file')) {
            $document = $request->file('file');
            $filename = 'Contracto-'.$data['lastname'].'-'.$data['name'].'-'.$data['document'] .'-'.now().'.' .$document->getClientOriginalExtension();
            $document->move(storage_path('app/public/documents'), $filename);
            $data['file'] = 'documents/'.$filename;
        }else{
            $data['file'] = $contract->file;
        }
        
        try {
            if ($contract->update($data)) {
            $success="Contrato actualizado.";
                return redirect()->route('contract.index')->with('success', $success);
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->back()->with('error', $error);
        }
        
        return redirect()->back()->with('error', 'No se pudo registrar el registro.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Contract::find($id);
        
        $empleado->delete();
        return response()->json(['message' => 'contrato']);
    }
  
}
