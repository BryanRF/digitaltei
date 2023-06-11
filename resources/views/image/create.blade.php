    @extends('layouts.base') @prepend('styles') @section('content')
    <div class="container px-6 mx-auto grid">
        <div class="grid grid-cols-6">
        <h2 class="col-span-6 md:col-span-3 my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$titulo}}
        </h2>
        </div>
        <style>
.image-container {
    position: relative;
}

.delete-image {
    position: absolute;
    top: 0;
    right: 0;
    width: 28px;
    height: 28px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: transparent;
    border: none;
    cursor: pointer;
}

.delete-image svg {
    width: 100%;
    height: 100%;
    color: #fff;
    background: rgba(247, 54, 54, 0.877);
}
.py-5 {
  padding-top: 5rem;
  padding-bottom: 5rem;
}
.rounded-lg {
  border-radius: 0.5rem;
}



        </style>
        <!-- General elements -->
        <!-- Inputs with icons -->
        <div class="py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"><!-- Snap Point -->
            <!-- Contents -->
            <div class="relative w-full flex gap-6 snap-x snap-mandatory overflow-x-auto py-3 ">
                <div class="snap-start scroll-mx-6 shrink-0">
                    <div class="shrink-0 w-0"></div>
                </div>
                @foreach($images as $image)
                <div class="snap-start scroll-mx-6 shrink-0">
                    <div class="image-container relative shrink-0 w-80 h-40 rounded-lg shadow-xl bg-white image-{{$image->id}}">

                        <img class="w-50 h-full rounded-lg " src="{{ Storage::url($image->name) }}">
                        <button  data-id="{{$image->id}}" class="eliminar delete-image absolute top-2 right-2 bg-red-600 hover:button bg-transparent text-white rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <form method="post" action="{{route('image.store',$product_id)}}"  enctype="multipart/form-data" class="dropzone" id="my-great-dropzone">
                @csrf
            </form>
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 px-3 mt-6 ">
                    <button  type="button" id="back" class="back bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        regresar
                    </button>
                </div>
            </div>
                </div>
    </div>


    @endsection

    @section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
            const backButton = document.getElementById('back'); // Obtiene el botón por su ID
            backButton.addEventListener('click', function() {
            window.location.href = "{{ route('product.index') }}"; // Realiza la acción al hacer clic en el botón
            });
            Dropzone.options.myGreatDropzone  = {
            dictDefaultMessagedictDefaultMessage: "Arrastra aquí los archivos para subirlos",
            dictFallbackMessage: "Tu navegador no soporta la carga de archivos mediante arrastrar y soltar.",
            dictFallbackText: "Por favor, utiliza el formulario de respaldo de abajo para cargar tus archivos como en los viejos tiempos.",
            dictInvalidFileType: "No puedes subir archivos de este tipo.",
            dictCancelUpload: "Cancelar carga",
            acceptedFiles: "image/*",
            maxFileSize:2,
            maxFile:4,
            dictCancelUploadConfirmation: "¿Estás seguro de que quieres cancelar la carga?",
            dictRemoveFile: "Eliminar archivo",
            dictMaxFilesExceeded: "Has excedido el número máximo de archivos que puedes subir.",
            header: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        };


            </script>

<script>
    // Agregar evento de clic al botón de eliminar
    var deleteButtons = document.querySelectorAll('.delete-image');

    $(document).on('click', '.eliminar', function () {


            var imageId = this.getAttribute('data-id');
            // Realizar la solicitud AJAX para eliminar la imagen
            $.ajax({
                url: '{{ route("image.destroyed", ":id") }}'.replace(':id', imageId),
                type: 'DELETE',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    console.log(data);
                    Swal.fire({
                    icon: 'success',
                    title: 'Se eliminó correctamente',
                    showConfirmButton: false,
                    timer: 1500,
                    allowOutsideClick: false
                    })
                    $('.image-' + imageId).remove();
                }
            }).fail(function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al eliminar el registro',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

</script>
@endsection