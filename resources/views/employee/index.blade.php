@extends('layouts.base')
@section('content')

<div class="container px-6 mx-auto grid">
    <div class="grid grid-cols-6">
        <h2 class="col-span-6 md:col-span-3 my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$titulo}}
            <a href="{{route('employee.create')}}"
                class=" items-center mt-3 justify-between px-4 py-2 text-sm font-semibold leading-5 text-white transition-colors duration-150 bg-amber-500 border border-transparent rounded-lg active:bg-amber-500 hover:bg-amber-700 focus:outline-none focus:shadow-outline-amber">
                Nuevo
                
            </a>
        </h2>
    </div>
   
    <!-- New Table -->
    <div class="w-full overflow-hidden bg-white dark:bg-gray-800 rounded-lg text-gray-500  shadow-xs dark:text-gray-400">
        
        
        <div class="w-full overflow-x-auto ">
            
            <table class="w-full whitespace-no-wrap display">
                <thead>
                    <tr class="text-xs  font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">DNI</th>
                        <th class="px-4 py-3">Correo</th>
                        {{-- <th class="px-4 py-3">Direccion</th> --}}
                        <th class="px-4 py-3">Numero</th>
                        {{-- <th class="px-4 py-3">Genero</th> --}}
                        <th class="px-4 py-3">F.Nacimiento</th>
                        <th class="px-4 py-3">Documento</th>
                        <th class="px-4 py-3 text-center no-export">Opciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($employee as $value)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                    <img class="object-cover w-full h-full rounded-full" src="{{ Storage::url($value->avatar) }}"/>
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold">{{$value->name}} {{$value->lastname}}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        - {{$value->job_name}}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <button class="px-2 py-1 text-xs font-semibold leading-tight text-black bg-gray-300 rounded-full " onclick="copyText('{{$value->document}}')" title="Copiar">{{$value->document}}</button>
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <button class="px-2 py-1 text-xs font-semibold leading-tight text-black bg-gray-300 rounded-full " onclick="copyText('{{$value->email}}')" title="Copiar">{{$value->email}}</button>
                        </td>
                       
                        <td class="px-4 py-3 text-sm ">
                            <button class="px-2 py-1 text-xs font-semibold leading-tight text-black bg-gray-300 rounded-full " onclick="copyText('{{$value->phone}}')" title="Copiar">{{$value->phone}}</button>

                            
                        </td>
              
                        <td class="px-4 py-3 text-sm ">
                            {{ \Carbon\Carbon::parse($value->birthday_date)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-center no-export">
                            @if($value->file != null)
                            @if (strpos($value->file, '.pdf') !== false)
                                <a href="{{ Storage::url($value->file) }}" class="bg-red-500 text-xs hover:bg-red-600 text-white font-bold p-2  text-center rounded" download>
                                    <i class="fas fa-download"></i> PDF
                                </a>
                            @elseif (strpos($value->file, '.doc') !== false)
                                <a href="{{ Storage::url($value->file) }}" class="bg-blue-500 text-xs hover:bg-blue-600 text-white font-bold p-2  text-center rounded" download>
                                    <i class="fas fa-download"></i> Word
                                </a>
                            @endif
                            @else
                                <button disabled class=" text-xs text-black bg-gray-300 p-2 text-center rounded" title="Sin archivo">
                                    <i class="fas fa-download"></i> Sin registro
                                </button>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-center no-export">
                            <a href ="{{route('employee.edit',$value)}}"  style=" border: none;" 
                            class="p-2 focus:outline-none focus:shadow-outline-gray
                             editar text-sm font-medium leading-5 text-gray-700
                              hover:text-gray-900 transition-colors duration-150
                               dark:text-gray-400 rounded"><i class="fas fa-edit"></i></a>
                            
                            {!! Form::open(['route' => ['employee.destroy', $value], 'method' => 'delete']) !!}
                            @csrf
                            <button type="submit" class="p-2 focus:outline-none focus:shadow-outline-gray eliminar 
                            text-sm font-medium leading-5 text-gray-700 hover:text-gray-900 transition-colors duration-150 dark:text-gray-400 rounded">
                                <i class="fas fa-trash-alt"></i> </button>
                            {!! Form::close() !!}
   
                        </td>
                        
                       
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
      
    </div>

  
</div>

<script>
          let day = new Date().toLocaleDateString('es-ES', {
	day: '2-digit',
	month: '2-digit',
	year: 'numeric',
	hour: 'numeric',
	minute: 'numeric',
	second: 'numeric'
 }).replace(',', '').replace(/\//g, '-');
    $('table.display').DataTable({

        "paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
		"columnDefs": [{
			"targets": "no-export",
			"exportable": false
		}],
		dom: 'Bflrtip',
                language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar", // Traducir "Copiar" a "Copiar" en español
                    "copyTitle": "Copiado al portapapeles",
                    "copySuccess": {
                    _: '%d filas copiadas',
                    1: '1 fila copiada'
                    }
                }
            },
		buttons: [{
			extend: 'copy',
			text: '<i class="fas fa-copy"></i> Copiar',
			exportOptions: {
				columns: ':not(.no-export)'
			}
		}, {
			extend: 'excel',
			text: '<i class="fas fa-file-excel"></i> Excel',
			exportOptions: {
				columns: ':not(.no-export)'
			},
			filename: "Lista de Empleados generado el "+ day,
			title: "Detalles de Empleados",
		}, {
			extend: 'pdf',
			text: '<i class="fas fa-file-pdf"></i> PDF',
			exportOptions: {
				columns: ':not(.no-export)'
			},
			filename: "Lista de Empleados generado el "+ day,
			title: "Detalles de Empleados",
			messageBottom: "\n Reporte generado el " + day,
			header: true,
			footer: true,
			customize: function(doc) {
				doc.styles.title = {
					fontSize: 16,
					fontWeight: 'bold',
					alignment: 'center'
				};
				doc.styles.tableHeader = {
					fontSize: 11,
					fontWeight: 'bold',
					fillColor: '#6699cc',
					color: '#ffffff',
					alignment: 'center',
					padding: 5,
					cellPadding: 5,
				};
				doc.styles.table = {
					fontSize: 10,
					alignment: 'center',
					cellPadding: 5,
					border: '3px solid #646464'
				};
			}
		}, {
			extend: 'print',
            orientation: 'landscape',
            pageSize: 'LEGAL',
			text: '<i class="fas fa-print"></i> Imprimir',
			exportOptions: {
				columns: ':not(.no-export)'
			},
			filename: "Lista de Empleados generado el "+ day,
			title: "Reporte generado el " + day,
		}, ],
        rowCallback: function(row, data, index) {
      $(row).css('background-color', 'transparent');
    }
	});







    function copyText(text) {
      const input = document.createElement('input');
      input.setAttribute('value', text);
      document.body.appendChild(input);
      input.select();
      document.execCommand('copy');
      document.body.removeChild(input);
      const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: false,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
 })

    Toast.fire({
    icon: 'success',
    title: 'Copiado correctamente'
    })
    
        }
        $('button.dt-button').removeClass('dt-button');

</script>
@endsection