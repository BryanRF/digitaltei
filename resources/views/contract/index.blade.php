@extends('layouts.base')
@section('content')

<div class="container px-6 mx-auto grid">
    <div class="grid grid-cols-6">
        <h2 class="col-span-6 md:col-span-3 my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$titulo}}
            <br>
            {{-- <a href="{{route('contract.create')}}"
                class=" items-center mt-3 justify-between px-4 py-2 text-sm font-semibold leading-5 text-white transition-colors duration-150 bg-amber-500 border border-transparent rounded-lg active:bg-amber-500 hover:bg-amber-700 focus:outline-none focus:shadow-outline-amber">
                Nuevo Contrato
                
            </a> --}}
            {{-- <a href="{{route('recycle.contract.index')}}"
                class=" items-center ml-2 mt-3 justify-between px-4 py-2 text-sm font-semibold leading-5 text-white transition-colors duration-150 bg-amber-500 border border-transparent rounded-lg active:bg-amber-500 hover:bg-amber-700 focus:outline-none focus:shadow-outline-amber">
                Papelera
                
            </a> --}}
        </h2>
      
    </div>
  
   
    <!-- New Table -->
    <div class="w-full overflow-hidden bg-white dark:bg-gray-800 rounded-lg text-gray-500  shadow-xs dark:text-gray-400">
        
        
        <div class="w-full overflow-x-auto ">
            
            <table class="w-full whitespace-no-wrap display">
                <thead>
                    <tr class="text-xs  font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Empleado</th>
                        <th class="px-4 py-3">DNI</th>
                        <th class="px-4 py-3">Cargo</th>
                        <th class="px-4 py-3">Posicion</th>
                        <th class="px-4 py-3">Fecha Inicio</th>
                        <th class="px-4 py-3">Fecha Fin</th>
                        <th class="px-4 py-3">Duracion</th>
                        <th class="px-4 py-3">Salario</th>
                        <th class="px-4 py-3 no-export">Documento</th>
                        <th class="px-4 py-3 text-center no-export">Opciones</th>
                    </tr>
                </thead>
               <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                  
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

 $.fn.dataTable.ext.errMode = 'none';
 
    t=$('table.display').DataTable({
        ajax: "{{ route('datatable.contract') }}",
        columns: [
        
        {data: 'employee_name', name: 'employee_name' },
        { 
            render: function (data, type, row, meta) {
                return  '<td class="px-4 py-3 text-sm">'+
                            '<button class="px-2 py-1 text-xs font-semibold hover:bg-gray-600 hover:text-white leading-tight text-black bg-gray-300 rounded-full " onclick="copyText(this.innerText)" title="Copiar">'+row.document+'</button>'+
                        '</td>';
            },
        },
        {data: 'job_name', name: 'job_name' },
        {data: 'description', name: 'description' },
        {data: 'start_date', name: 'start_date' },
        {data: 'end_date', name: 'end_date' },
        {data: 'duration', name: 'duration' },
        {data: 'salary', name: 'salary' },
        
    
        { 
            render: function (data, type, row, meta) {
                html ="";
                if (row.file != null) {
                    if (row.file.indexOf('.pdf') !== -1) {
                        html= '<a href="{{ Storage::url(":archivefile") }}" class="bg-red-500 text-xs hover:bg-red-600 text-white font-bold p-2 text-center rounded" download>' +
                               '<i class="fas fa-download"></i> PDF' +
                               '</a>';
                    } else if (row.file.indexOf('.doc') !== -1) {
                        html= '<a href="{{ Storage::url(":archivefile") }}" class="bg-blue-500 text-xs hover:bg-blue-600 text-white font-bold p-2 text-center rounded" download>' +
                               '<i class="fas fa-download"></i> Word' +
                               '</a>';
                    }
                } else {
                    html= '<button disabled class="text-xs text-black bg-gray-300 p-2 text-center rounded" title="Sin archivo">' +
                           '<i class="fas fa-download"></i> Sin registro' +
                           '</button>';
                }
                html = html.replace(/:archivefile/g, row.file);
                return html;
            },
            name: 'file',
            className: 'px-4 py-3 no-export'
        },
        {
            render: function (data, type, row, meta) {
        var employeeId = row.id;
        var editUrl = "{{ route('employee.edit', ':employee_id') }}";
        editUrl = editUrl.replace(':employee_id', employeeId);


    var html = ' <a href="{{route("employee.edit", ":employee_id")}}" style="border: none;" class="p-2 focus:outline-none focus:shadow-outline-gray editar text-sm font-medium leading-5 text-gray-700 hover:text-gray-900 transition-colors duration-150 dark:text-gray-400 rounded"><i class="fas fa-edit"></i></a>'+
               '<button class="p-2 focus:outline-none focus:shadow-outline-gray eliminar text-sm font-medium leading-5 text-gray-700 hover:text-gray-900 transition-colors duration-150 dark:text-gray-400 rounded"  data-id="' + row.id + '"><i class="fas fa-trash-alt"></i></button>';
        html = html.replace(/:employee_id/g, row.id);
    return html;
        }
        }
    ],
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

    $(document).on('click', '.eliminar', function () {
        var button = $(this);
    Swal.fire({
        title: 'Eliminar Empleado',
        text: "¿Está seguro de eliminar este registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.isConfirmed) {
            var row = button.closest('tr');
            let id = $(this).attr('data-id');
            deleteFila(id,row);
        }
    })
});





function deleteFila(id,row) {
    $.ajax({
        url: '{{ route("employee.destroyed", ":id") }}'.replace(':id', id),
        type: 'DELETE',
        data: {
            '_token': '{{ csrf_token() }}'
        },
        success: function (data) {
            console.log(data);
            
            Swal.fire({
            icon: 'success',
            title: 'Se eliminó a ' + data.message + ' del registro',
            showConfirmButton: false,
            timer: 1500,
            allowOutsideClick: false
            }).then(function () {
                t.row(row).remove().draw(false);
            });
        }
    }).fail(function () {
        Swal.fire({
            icon: 'error',
            title: 'Error al eliminar el registro',
            showConfirmButton: false,
            timer: 1500
        });
    });
}


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

                    @if(session('success') != null)
                    <script>
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

Swal.fire({
  position: 'top-end',
  icon: 'success',
  text: '{{ session("success") }}',
  showConfirmButton: false,
  timer: 1500
})

                    </script>
                  @endif
@endsection