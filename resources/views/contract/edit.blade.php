@extends('layouts.base') @prepend('styles') @section('content')
<div class="container px-6 mx-auto grid">
    <div class="grid grid-cols-6">
        <h2 class="my-6 font-semibold text-gray-700 dark:text-gray-200">
            {{($titulo)}}
        </h2>
    </div>
    <!-- General elements -->

    <!-- Inputs with icons -->
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        {!! Form::model($employee, [ 'method' => 'PUT', 'route' => ['employee.update', $employee], 'enctype' => 'multipart/form-data']) !!}
        @csrf
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                {{ Form::label('name', 'Nombre', ['class' => 'block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2']) }}
                {{ Form::text('name', old('name', $employee->name), [
                    'class' => 'block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input',
                    'id' => 'name',
                    'placeholder' => 'Nombre',
                ]) }}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('name') {{($message)}} @enderror
                </span>
            </div>
            <div class="w-full mb-6 md:w-1/2 px-3">
                {{ Form::label('lastname', 'Apellido', ['class' => 'block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2']) }}
                {{ Form::text('lastname', old('lastname', $employee->lastname), [
                    'class' => 'block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input',
                    'id' => 'lastname',
                    'placeholder' => 'Apellido',
                ]) }}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('lastname') {{($message)}} @enderror
                </span>
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                {{ Form::label('document','DNI', ['class' => 'block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2']) }}
                {{ Form::text('document', old('document',$employee->document), [ 'class' => 'block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input', 'placeholder' => 'Documento', 'id' => 'document']) }}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('document') {{($message)}} @enderror
                </span>
            </div>
            <div class="w-full mb-6 md:w-1/2 px-3">
                {!! Form::label('email', 'Correo Electrónico', ['class' => 'block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2']) !!}
                {!! Form::text('email', old('email',$employee->email),
                    ['class' => 'block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input','id' => 'email','type' => 'email','placeholder' => 'Correo Electrónico']) !!}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('email') {{($message)}} @enderror
                </span>
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                {!! Form::label('address', 'Dirección', [
                    'class' => 'block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2'
                ]) !!}
    
                {!! Form::text('address', old('address',$employee->address), [
                    'class' => 'block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input',
                    'placeholder' => 'Dirección',
                    'id' => 'address'
                ]) !!}
    
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('address') {{($message)}} @enderror
                </span>
            </div>
    
            <div class="w-full mb-6 md:w-1/2 px-3">
                {!! Form::label('birthday_date', 'Fecha de Nacimiento', [
                    'class' => 'block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2'
                ]) !!}
    
                {!! Form::date('birthday_date', old('birthday_date',$employee->birthday_date), [
                    'class' => 'block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input',
                    'placeholder' => 'Fecha de Nacimiento',
                    'id' => 'birthday_date'
                ]) !!}
    
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('birthday_date') {{($message)}} @enderror
                </span>
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                {!! Form::label('gender', 'Género', ['class' => 'block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2']) !!}
                {!! Form::select('gender', ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'], $employee->gender, ['class' => 'block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select dark:focus:shadow-outline-gray', 'id' => 'gender']) !!}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('gender') {{($message)}} @enderror
                </span>
            </div>
            <div class="w-full mb-6 md:w-1/2 px-3">
                {!! Form::label('phone', 'Teléfono', ['class' => 'block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2']) !!}
                {!! Form::tel('phone', old('phone',$employee->phone), ['class' => 'block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input', 'id' => 'phone', 'placeholder' => 'Teléfono']) !!}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('phone') {{($message)}} @enderror
                </span>
            </div>
        </div>
        <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="file">
                Documentos
            </label>
            <div class="relative w-full">
                {!! Form::file('file', ['id' => 'file', 'class' => 'block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100', 'placeholder' => 'Seleccione un archivo']) !!}
                <span id="document_name" class="file:text-sm file:font-medium text-slate-500 {{( empty($employee->file) ? 'hidden' : '' )}}">{{($employee->file)}}</span>
            </div>
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('file') {{($message)}} @enderror
            </span>
        </div>
        <div class="w-full md:w-1/2 mb-6 px-3">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="avatar">
                Avatar
            </label>
            <div class="flex items-center">
                <div class="shrink-0">
                    <img class="h-8 w-8 mr-3 object-cover rounded-full" src="{{( Storage::url($employee->avatar) )}}" />
                </div>
                <label class="block w-full">
                    {!! Form::file('avatar', ['id' => 'avatar', 'accept' => 'image/*', 'class' => 'block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100']) !!}
                </label>
            </div>
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('avatar') {{($message)}} @enderror
            </span>
        </div>
    </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="jobs_id">
                    Cargo
                </label>
                {{Form::select('jobs_id', $jobs->pluck('name','id'), $employee->jobs_id, ['class' => 'block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select dark:focus:shadow-outline-gray']) }}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('jobs_id') {{($message)}} @enderror
                </span>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="enabled">
                    Habilitar usuario
                </label>
                {{Form::checkbox('isUser', $employee->isUser, $employee->isUser, ['class' => 'form-checkbox text-indigo-600 dark:text-indigo-400', 'id' => 'isUser']) }}
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                {!! Form::submit('Actualizar', ['class' => 'bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline']) !!}
                <a href="{{(route('employee.index'))}}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    regresar
                </a>
            </div>
        </div>
    
        {!! Form::close() !!}
  
        <!-- Invalid input -->
    </div>
</div>
<style>
    .file-cta {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .file-icon {
        font-size: 1.5em;
        margin-right: 10px;
    }

    .file-label {
        font-size: 0.875em;
    }
</style>
<script>
    document.getElementById("avatar").addEventListener("change", function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector(".shrink-0 img").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>
@endsection
