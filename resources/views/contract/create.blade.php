@extends('layouts.base') @prepend('styles') @section('content') 
<div class="container px-6 mx-auto grid">
    <div class="grid grid-cols-6">
      <h2 class="col-span-6 md:col-span-3 my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        {{$titulo}}
      </h2>
    </div>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form id="getEmployee" >
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="document">
                    DNI de Empleado <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
                </label>
                <div class="flex">
                    <input class="block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input"
                        id="document" value="{{old('document')}}" type="text" name="document" placeholder="DNI">
                    <button type="button"
                        class="buscar bg-red-600 mt-1 px-3 ms-2 hover:bg-red-700 text-white font-bold 
                         rounded focus:outline-none focus:shadow-outline flex items-center">
                        <i class="fa-solid fa fa-magnifying-glass"></i>
                    </button>
                </div>
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('employee_id')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="document">
                    Nombre del empleado <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
                </label>
                <div class="flex">
                    <input class="block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input"
                    id="name" value="{{ old('name') }}" type="text" name="name" placeholder="Nombre del empleado" readonly>

               
                </div>
                
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('employee_id')
                    {{ $message }}
                    @enderror
                </span>
            </div>
        </div>
    </form>

    
<form method="post" action="{{route('contract.store')}}"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="employee_id" name="employee_id" >

    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="document">
                Descripcion 
            </label>
            <input value="{{ old('description') }}" class="block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700  form-input"
            id="description" type="text" name="description"   placeholder="Descripcion del contrato.">
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('description') 
                {{($message)}}
                @enderror
              </span>
        </div>
        <div class="w-full mb-6 md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="lastname">
                Salario <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <input value="{{ old('salary') }}" class="block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700  form-input"
            id="salary" type="number" name="salary"   placeholder="Salario">
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('salary') 
                {{($message)}}
                @enderror
              </span>
        </div>
        
    </div>
    <div class="flex flex-wrap">
        <div class="w-full mb-6 md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="birthday_date">
                Fecha de Inicio <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <input value="{{ old('start_date') }}" class="block w-full mt-1 text-sm border-gray-600  text-gray-700 dark:text-gray-300 dark:bg-gray-700  form-input"
            id="start_date" type="date" name="start_date"   placeholder="Fecha de inicio">
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('start_date') 
                {{($message)}}
                @enderror
              </span>
        </div>
        <div class="w-full mb-6 md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="birthday_date">
                Fecha Final <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <input value="{{ old('end_date') }}" class="block w-full mt-1 text-sm border-gray-600  text-gray-700 dark:text-gray-300 dark:bg-gray-700  form-input"
            id="end_date" type="date" name="end_date"   placeholder="Fecha final">
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('end_date') 
                {{($message)}}
                @enderror
              </span>
        </div>
    </div>
   
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="file">
                Documentos 
            </label>
            <div class="relative w-full">
                <input value="{{ old('file') }}" id="file" name="file" type="file" class="block w-full text-sm text-slate-500
                  file:mr-4 file:py-2 file:px-4
                  file:rounded-full file:border-0
                  file:text-sm file:font-semibold
                  file:bg-amber-50 file:text-amber-700
                  hover:file:bg-amber-100 " placeholder="Seleccione un archivo">
                <span class="file:text-sm file:font-medium text-slate-500 " id="document_name">{{ old('file') }}</span>
              </div>
              <span class="text-xs text-red-600 dark:text-red-400">
                @error('file')
                {{($message)}}
                @enderror
              </span>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="job_id">
                Cargo <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <select class="block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select  dark:focus:shadow-outline-gray"
            id="job_id" name="job_id">
            <option  value="" >Seleccione una opcion</option>

                @foreach($jobs as $job)
                <option value="{{ $job->id }}" @if(old('job_id') == $job->id) selected @endif>{{ $job->name }}</option>
                @endforeach
            </select>
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('job_id') 
                {{($message)}}
                @enderror
              </span>
        </div>
    </div>
    <div class="flex flex-wrap">
        
        
    </div>
<div class="flex flex-wrap">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <button class="bg-amber-600 hover:bg-amber-700 text-white font-bold
         py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="submit">
            Registrar
        </button>
        <button type="button"  id="back" 
        class="bg-red-600 hover:bg-red-700 
        text-white font-bold py-2 px-4 rounded 
        focus:outline-none focus:shadow-outline">
            regresar
        </button>
    </div>
</div>
</form>
    </div>
  </div>
  <script>
    const backButton = document.getElementById('back'); // Obtiene el botón por su ID

backButton.addEventListener('click', function() {
  window.location.href = "{{ route('contract.index') }}"; // Realiza la acción al hacer clic en el botón
});

$(document).on('click', '.buscar', function () {
    dni= document.getElementById('document').value;
    $.ajax({
        url: '{{ route("employee.dni", ":dni") }}'.replace(':dni', dni),
        type: 'GET',
        
        success: function (data) {
            if(data.id!=null){
            Swal.fire({
            icon: 'success',
            title: 'Empleado encontrado',
            showConfirmButton: false,
            timer: 1500,
            allowOutsideClick: false
            });
            // Obtener el elemento del campo de entrada por su id
            var inputElement = document.getElementById("name");
            // Cambiar el valor del campo de entrada
            var fullName = data.name + ' ' + data.lastname;
            inputElement.value = fullName;
            var inputElement = document.getElementById("employee_id");
            // Cambiar el valor del campo de entrada
            inputElement.value = data.id;
        }else{
                Swal.fire({
            icon: 'warning',
            title: 'No hay ningun empleado con ese DNI',
            showConfirmButton: false,
            timer: 1500,
            allowOutsideClick: false
            });
            document.getElementById("name").value="";
            document.getElementById("employee_id").value="";
            }
        }
    }).fail(function () {
            document.getElementById("name").value="";
            document.getElementById("employee_id").value="";
    });
});
  </script>
  

  @endsection