<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="es">
    <head>
        @vite('resources/css/app.css')
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/img/logo.png') }}">
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Digitaltei | {{$titulo}}</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
        <link rel="preconnect" href="https://fonts.googleapis.com"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
        <link href="https://fonts.googleapis.com/css2?family=Atma:wght@600&family=Montserrat:ital,wght@0,800;1,800&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-free-6.3.0-web/css/all.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.13.2/af-2.5.2/b-2.3.4/b-html5-2.3.4/b-print-2.3.4/cr-1.6.1/date-1.3.0/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.css"/>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.2/af-2.5.2/b-2.3.4/b-html5-2.3.4/b-print-2.3.4/cr-1.6.1/date-1.3.0/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.13.2/af-2.5.2/b-2.3.4/b-html5-2.3.4/b-print-2.3.4/cr-1.6.1/date-1.3.0/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.js"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/modificacion.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/datatables-taillwind.css') }}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
        <style>
            h1{
              font-family: 'Righteous', cursive;
              font-size: 25px;
            }
            .back{

              background-color: #F1A705;
            }
            .yellow{
                color: #EFC41D;
            }
            .button-yellow{
              background-color: #EFC41D;
              color:white;

            }
          
        </style>
  </head>
  <body >
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900 back">
      <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true"
            class=" object-cover w-full h-full "
            src="{{asset('/assets/img/forgot-password-office.jpeg') }}"
            alt="Office"/>
          </div>
          <form  action="{{route('password.email')}}"  method="POST"class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            @csrf
            <div class="w-full">
              <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                Recuperar contraseña
              </h1>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Correo Electronico</span>
                <input name ="email" id ="email"class="block w-full mt-1 text-sm  text-black dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-black-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="ejemplo@email.com"/>
              </label>
              @error('email')
                    
              <span class="text-xs text-red-600 dark:text-red-400">
                  {{ $message }}
              </span>
          
              @enderror

              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button type="submit" id="enviar" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Enviar recuperacion
              </button>
              
              <p class="mt-1">
                <a
                  class="text-sm font-medium text-black dark:text-white hover:underline"
                  href="{{route('auth.login')}}">
                  <strong>Regresar a iniciar sesion</strong>
                </a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
  <script>
    const backButton = document.getElementById('enviar'); 
    backButton.addEventListener('click', function() {
      backButton.innerHTML = `
    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
      <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
    </svg>
    Enviando correo...
  `;
     
    });
      </script>

@if(session('status') != null)
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Swal.fire({
        position: 'top-end',
        icon: 'success',
        text: '{{ session("status") }}',
        showConfirmButton: false,
        timer: 1500
    })

    // Eliminar la sesión 'success' después de mostrar el mensaje
    @php
        session()->forget('status');
    @endphp
</script>
@endif
</html>
