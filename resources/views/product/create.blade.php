    @extends('layouts.base') @prepend('styles') @section('content')
    <div class="container px-6 mx-auto grid">
    <div class="grid grid-cols-6">
        <h2 class="col-span-6 md:col-span-3 my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
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
                <div class="w-full md:w-1/2 mb-6 px-3">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="image">
                Imagen principal
                </label>
                <div class="flex items-center ">
                    <div class="shrink-0">
                        <img class="h-8 w-8 mr-3 object-cover rounded-full hidden" src=""/>
                    </div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input"></label>
                    <input class="block w-full text-sm text-gray-900 border
                        border-gray-300 rounded-lg cursor-pointer
                        bg-gray-50 dark:text-gray-400 focus:outline-none
                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        type="file" id="image" name="image" accept="image/*" >
                </div>
                <span class="text-xs text-red-600 dark:text-red-400">
                @error('image')
                {{($message)}}
                @enderror
                </span>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-400 text-xs font-bold mb-2" for="price">
                Precio
                </label>
                <input class="block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:bg-gray-700 form-input"
                    id="price" type="text" name="price" placeholder="Ingrese precio">
                <span class="text-xs text-red-600 dark:text-red-400">
                @error('price')
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
                    id="category-select" name="category_id">
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
                <select class="block select-disabled w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select  dark:focus:shadow-outline-gray"
                    id="subcategory-select" name="subcategory_id" >
                    <option  value="" >Seleccione una opcion</option>

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
                <button class="bg-base-600 active:bg-gray-500 hover:bg-gray-700 font-bold
                    py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                Registrar
                </button>
                <button  type="button" id="back" class="back bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                regresar
                </button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <style>
        .select-disabled {
        background-color: #e9e9e9;
        color: #999999;
        cursor: not-allowed;
        }
    </style>
    <script>
    const backButton = document.getElementById('back'); // Obtiene el botón por su ID
    backButton.addEventListener('click', function() {
        window.location.href = "{{ route('product.index') }}"; // Realiza la acción al hacer clic en el botón
    });

    </script>
    <script>
            $(document).ready(function() {
                // Obtén el elemento select de categoría y el elemento select de subcategoría
                categorySelect = $('#category-select');
                subcategorySelect = $('#subcategory-select');
                var categorySelect = $('#category-select');
                categorySelect.change(function() {
                var categoryId = $(this).val();
                getReverse(categoryId);

                });
            });
            function getReverse(categoryId) {
            var subcategorySelect = document.getElementById('subcategory-select');
            subcategorySelect.classList.remove('select-disabled');
            $.ajax({
                url: '{{ route("datatable.subcategory.category", ":id") }}'.replace(':id', categoryId),
                type: 'GET',
                success: function (response) {
                    // Parsea la respuesta JSON recibida
                    var subcategories = response.data;
                    // Vacía el select de subcategoría
                    subcategorySelect.innerHTML = '';
                    // Agrega las opciones de subcategoría al select
                    subcategorySelect.innerHTML += '<option value="">Seleccione una opción</option>';
                    subcategories.forEach(function (subcategory) {
                        subcategorySelect.innerHTML += '<option value="' + subcategory.id + '">' + subcategory.name + '</option>';
                    });
                },
                error: function (xhr) {
                    // Maneja los errores de la solicitud AJAX si es necesario
                    console.log(xhr.responseText);
                }
            });
}
    </script>
    @endsection