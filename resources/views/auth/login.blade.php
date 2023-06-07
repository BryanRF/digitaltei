<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="es">
    <head>
        @vite('resources/css/app.css')
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/img/logo.ico') }}">
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
    <div class="flex items-center min-h-screen p-6 back">
      <div class="flex-1 h-full max-w-4xl
       mx-auto overflow-hidden
        bg-white rounded-lg shadow-xl dark:bg-gray-800">
      
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <a href="#"class="h-32 md:h-auto md:w-1/2">
            <img class="object-cover w-full h-full "src="{{asset('/assets/img/login-office.png') }}" />
            {{-- <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"src="{{asset('/assets/img/login-office-dark.jpeg') }}" alt="Office"/> --}}
          </a>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1 class="mb-4 text-center mx-auto  font-semibold text-gray-700 dark:text-gray-200">
                INICIA SESION EN <strong class="yellow">DIGITALTEI</strong>
              </h1>
        <form method="post" action="{{route('auth.login.employee')}}">
          @csrf
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Correo Electronico</span>
                  <input id="email" name="email" value="{{old('email')}}" class="block w-full mt-1 text-sm dark:border-gray-600 text-black
                   dark:bg-gray-700 focus:border-amber-400 focus:outline-none 
                   focus:shadow-outline-amber dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                  placeholder="ejemplo@email.com"/>
                  <span class="text-xs text-red-600 dark:text-red-400">
                
                    @error('email')
                    
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                    
                @enderror
              
                  </span>
                </label>
                <label class="block mt-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Contraseña</span>
                  <input id="password" name="password" value="{{old('password')}}"
                    class="block w-full mt-1 text-sm dark:border-gray-600 text-black
                    dark:bg-gray-700 focus:border-amber-400 focus:outline-none 
                    focus:shadow-outline-amber dark:text-gray-300 
                    dark:focus:shadow-outline-gray form-input"
                    placeholder="Ingrese su contraseña"
                    type="password"/>
                    <span class="text-xs text-red-600 dark:text-red-400">
                      @error('password') 
                      {{($message)}}
                      @enderror
                    </span>
                </label>
                <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium  leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                  INGRESAR
                </button>
              </form>
            
              <p class="mt-4">
                <a class="text-sm font-medium text-black dark:text-white hover:underline"
                href="{{route('auth.forgot-password')}}">
                  <strong>Olvidaste tu contraseña?</strong>
                </a>
              </p>
              <p class="mt-1">
                <a
                  class="text-sm font-medium text-black dark:text-white hover:underline"
                  href="{{route('auth.register.show')}}">
                  <strong>Crear cuenta</strong>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>
