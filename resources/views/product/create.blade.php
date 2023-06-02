@extends('layouts.base') @prepend('styles') @section('content') 
<div class="container px-6 mx-auto grid">
    <div class="grid grid-cols-6">
      <h2 class="my-6  font-semibold text-gray-700 dark:text-gray-200">
        {{$titulo}}
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
<form method="post" action="{{route('product.store')}}"  enctype="multipart/form-data">
    @csrf
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="name">
                Nombre <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <input class="block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700  form-input"
            id="name" type="text" name="name"   placeholder="Nombre">
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('name') 
                {{($message)}}
                @enderror
              </span>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="category_id">
                Tipo de producto <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <select class="block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select  dark:focus:shadow-outline-gray"
            id="category_id" name="category_id">
            <option  value="" >Seleccione una opcion</option>
                @foreach($types as $brand)
                    <option  value="{{($brand->id)}}" >{{($brand->name)}}</option>
                @endforeach
            </select>
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('category_id') 
                {{($message)}}
                @enderror
              </span>
        </div>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="document">
                Descripcion <i class="fa-regular fas fa-circle-exclamation" title="Deber ser unico"></i>
            </label>
            <input class="block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700  form-input"
            id="description" type="text" name="description"   placeholder="Descripcion">
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('description') 
                {{($message)}}
                @enderror
              </span>
        </div>
        <div class="w-full mb-6 md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="email">
                Presentacion <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <input class="block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700  form-input"
            id="presentation" type="text" name="presentation"  placeholder="Correo Electrónico">
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('presentation') 
                {{($message)}}
                @enderror
              </span>
        </div>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="category_id">
                Marca <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <select class="block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select  dark:focus:shadow-outline-gray"
            id="brand_id" name="brand_id">
            <option  value="" >Seleccione una opcion</option>
                @foreach($brands as $brand)
                    <option  value="{{($brand->id)}}" >{{($brand->name)}}</option>
                @endforeach
            </select>
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('brand_id') 
                {{($message)}}
                @enderror
              </span>
        </div>
        <div class="w-full mb-6 md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="birthday_date">
                Utilidad <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <input class="block w-full mt-1 text-sm border-gray-600  text-gray-700 dark:text-gray-300 dark:bg-gray-700  form-input"
            id="birthday_date" type="text" name="birthday_date"   placeholder="Utilidad del producto">
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('birthday_date') 
                {{($message)}}
                @enderror
              </span>
        </div>
    </div>
   
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 mb-6 px-3">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="image">
                Imagen
            </label>
            <div class="flex items-center ">
                <div class="shrink-0">
                    <img class="h-8 w-8 mr-3 object-cover rounded-full hidden" src=""/>
                    
                  </div>
                  <label class="block w-full">
                    <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-amber-50 file:text-amber-700
                    hover:file:bg-amber-100 "/>
                  </label>
            </div>
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('image') 
                {{($message)}}
                @enderror
              </span>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="address">
                Precio
            </label>
            <input class="block w-full mt-1 text-sm  text-gray-700 dark:text-gray-300 dark:bg-gray-700  form-input"
            id="address" type="number" name="address"  placeholder="Ingrese precio">
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('address') 
                {{($message)}}
                @enderror
              </span>
        </div>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="category_id">
                Categoria <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <select class="block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select  dark:focus:shadow-outline-gray"
            id="category_id" name="category_id">
            <option  value="" >Seleccione una opcion</option>
                @foreach($categories as $category)
                    <option  value="{{($category->id)}}" >{{($category->name)}}</option>
                @endforeach
            </select>
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('category_id') 
                {{($message)}}
                @enderror
              </span>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="category_id">
                Sub Categoria <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
            </label>
            <select class="block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select  dark:focus:shadow-outline-gray"
            id="subcategory_id" name="subcategory_id">
            <option  value="" >Seleccione una opcion</option>
                @foreach($subcategories as $brand)
                    <option  value="{{($brand->id)}}" >{{($brand->name)}}</option>
                @endforeach
            </select>
            <span class="text-xs text-red-600 dark:text-red-400">
                @error('subcategory_id') 
                {{($message)}}
                @enderror
              </span>
        </div>
    </div>


<div class="flex flex-wrap">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <button class="bg-amber-600 hover:bg-amber-700 text-white font-bold
         py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="submit">
            Registrar
        </button>
        <a  href="{{(route('product.index'))}}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            regresar
        </a>
    </div>
</div>
</form>
    </div>
  </div> @endsection