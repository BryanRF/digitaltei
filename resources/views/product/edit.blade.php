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
       
        {!! Form::model($product, [ 'method' => 'PUT', 'route' => ['product.update', $product], 'enctype' => 'multipart/form-data']) !!}
        @csrf
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="name">
                    Nombre <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
                </label>
                {!! Form::text('name', old('name'), ['class' => 'block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input', 'id' => 'name', 'placeholder' => 'Nombre']) !!}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('name') 
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="category_id">
                    Tipo de producto <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
                </label>
                {{Form::select('type_id', $types->pluck('name','id'), $product->type_id, ['class' => 'block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select dark:focus:shadow-outline-gray', 'id' => 'type-select']) }}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('category_id') 
                    {{ $message }}
                    @enderror
                </span>
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="description">
                    Descripción <i class="fa-regular fas fa-circle-exclamation" title="Deber ser único"></i>
                </label>
                {!! Form::text('description', old('description'), ['class' => 'block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input', 'id' => 'description', 'placeholder' => 'Descripción']) !!}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('description') 
                    {{ $message }}
                    @enderror
                </span>
            </div>
            
        </div>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="brand_id">
                    Marca <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
                </label>
                {{Form::select('brand_id', $brands->pluck('name','id'), $product->brand_id, ['class' => 'block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select dark:focus:shadow-outline-gray']) }}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('brand_id') 
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="presentation">
                    Presentación <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
                </label>
                {!! Form::text('presentation', old('presentation'), ['class' => 'block w-full mt-1 text-sm border-gray-600 text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input', 'id' => 'presentation', 'placeholder' => 'Correo Electrónico']) !!}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('presentation') 
                    {{ $message }}
                    @enderror
                </span>
            </div>
         
        </div>
       
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 mb-6 px-3">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="image">
                    Imagen
                </label>
                <div class="flex items-center">
                    <div class="shrink-0">
                        <img class="h-8 w-8 mr-3 object-cover rounded-full hidden" src=""/>
                    </div>
                    <label class="block w-full">
                        {!! Form::file('image', ['id' => 'image', 'accept' => 'image/*', 'class' => 'block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100']) !!}
                    </label>
                </div>
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('image') 
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="price">
                    Precio
                </label>
                {!! Form::number('price', old('price'), ['class' => 'block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input', 'id' => 'price', 'placeholder' => 'Ingrese precio']) !!}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('price') 
                    {{ $message }}
                    @enderror
                </span>
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="category_id">
                    Categoria <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
                </label>
                {{Form::select('category_id', $categories->pluck('name','id'), $product->categories_id, ['class' => 'block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select dark:focus:shadow-outline-gray', 'id' => 'category-select']) }}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('category_id') 
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="subcategory_id">
                    Sub Categoria <i class="fa-regular fas fa-circle-exclamation" title="Importante"></i>
                </label>
                {{Form::select('subcategory_id',  $subcategories->pluck('name','id'), $product->subcategory_id, ['class' => 'block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select dark:focus:shadow-outline-gray', 'id' => 'subcategory-select']) }}
                <span class="text-xs text-red-600 dark:text-red-400">
                    @error('subcategory_id') 
                    {{ $message }}
                    @enderror
                </span>
            </div>
        </div>
        
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                {!! Form::submit('Actualizar', ['class' => 'bg-base-600 active:bg-gray-500 hover:bg-gray-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline']) !!}
                <button type="button" id="back" class="back bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    regresar
                </button>
            </div>
        </div>
    
    {!! Form::close() !!}
    
     
    </div>
</div>
<script>
    const backButton = document.getElementById('back'); // Obtiene el botón por su ID
    backButton.addEventListener('click', function() {
      window.location.href = "{{ route('product.index') }}"; // Realiza la acción al hacer clic en el botón
    });
      </script>
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
    document.getElementById("image").addEventListener("change", function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector(".shrink-0 img").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>
<script>
    $(document).ready(function() {
        // Obtén el elemento select de categoría y el elemento select de subcategoría
         categorySelect = $('#category-select');
         subcategorySelect = $('#subcategory-select');
         SubcategoryId = subcategorySelect.val();
         console.log('Primer id');
         console.log(SubcategoryId);
        
// Realiza una solicitud AJAX para obtener las subcategorías correspondientes a la categoría seleccionada
$.ajax({
    url: '{{ route("datatable.category.subcategory", ":id") }}'.replace(':id', SubcategoryId),
    type: 'GET',
    success: function(response) {
        console.log(response.data);
        var categories = (response.data);
        categorySelect.empty();
        $.each(categories, function(index, category) {
            categorySelect.append('<option value="' + category.id + '">' + category.name + '</option>');
        });
    },
    error: function(xhr) {
        console.log(xhr.responseText);
    }
});
var categorySelect = $('#category-select');

console.log('2do id');
var categoryId = categorySelect.val();
         console.log(categoryId);
getReverse(categoryId);

        categorySelect.change(function() {
            var categoryId = $(this).val();

            getReverse(categoryId);
            
        });
    });

         function getReverse(categoryId){
             subcategorySelect = $('#subcategory-select');
             
             console.log(categoryId);
            $.ajax({
                url: '{{ route("datatable.subcategory.category", ":id") }}'.replace(':id', categoryId),
                type: 'GET',
                success: function(response) {
                    console.log(response.data);
                    // Parsea la respuesta JSON recibida
                    var subcategories = (response.data);

                    // Vacía el select de subcategoría
                    subcategorySelect.empty();

                    // Agrega las opciones de subcategoría al select
                    $.each(subcategories, function(index, subcategory) {
                        subcategorySelect.append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                    });
                },
                error: function(xhr) {
                    // Maneja los errores de la solicitud AJAX si es necesario
                    console.log(xhr.responseText);
                }
            });
         }
</script>

@endsection
