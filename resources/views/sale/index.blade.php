@extends('layouts.base')
@section('content')

<div class="container px-6 mx-auto grid">
    <div class="grid grid-cols-6">
        <h2 class="col-span-6 md:col-span-3 my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$titulo}}
            <a href="{{route('product.create')}}"
                class=" items-center mt-3 justify-between
                px-4 py-2 text-sm font-semibold leading-5
                transition-colors
                duration-150    border border-transparent
                rounded-lg bg-base-600 active:bg-gray-500
                hover:bg-gray-700 focus:outline-none focus:shadow-outline-amber">
                Nuevo
            </a>
        </h2>
    </div>
    <!-- New Table -->
    <div class="w-full overflow-hidden bg-white dark:bg-gray-800 rounded-lg text-gray-500  shadow-xs dark:text-gray-400">
        <div class="w-full overflow-x-auto " >
            <table class="w-full whitespace-no-wrap display">
                <thead>
                    <tr class="text-xs  font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Cliente</th>
                        <th class="px-4 py-3">Direccion</th>
                        <th class="px-4 py-3">Telefono </th>
                        <th class="px-4 py-3 no-export text-center">Codigo QR </th>
                        <th class="px-4 py-3 text-center">Codigo </th>
                        <th class="px-4 py-3 text-center">Estado de Pago</th>
                        <th class="px-4 py-3">Detalles</th>
                        <th class="px-4 py-3">Metodo de Pago</th>
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3 text-center no-export">Opciones</th>
                    </tr>
                </thead>

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

        t = $('table.display').DataTable({
            ajax: "{{route('datatable.sale')}}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },


                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    render: function(data, type, row, meta) {
                        var generateQrRoute = "{{ route('barcode.generate-qr', ':code') }}";
                        return '<td class=" flex justify-center items-center">' +
                            '<button  id="redirect" class="  redirect button p-2   hover:button active:button dark:button leading-tight rounded " data-id="\'' + row.code + '\'" title="Ver"><i class="fa fas fa-qrcode text-2xl" aria-hidden="true"></i><p class="text-sm">Ver QR</p></button>' +
                            '</td>'.replace(/:code/g, row.code);
                    },
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).addClass('text-center');
                    }
                },
                {
                    render: function(data, type, row, meta) {
                        var generateQrRoute = "{{ route('barcode.generate-qr', ':code') }}";
                        return '<td class=" flex justify-center items-center">' +
                            '<button class=" button p-2  hover:button active:button dark:button  rounded "  onclick="copyText(\'' + row.code + '\')" title="Copiar"><i class="fa fa-key text-2xl fas" aria-hidden="true"></i> <p class="text-sm">Copiar</p>' + '<p hidden>' + row.code + '</p>' + '</button>' +
                            '</td>'.replace(/:code/g, row.code);
                    },
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).addClass('text-center');
                    }
                },
                {
                    render: function(data, type, row, meta) {
                        var html = '<div class="px-4 py-3 text-sm">' +
                            '<span class="px-2 py-1 text-xs font-semibold rounded';
                        if (row.payment_status == 'Pagado') {
                            html += ' bg-lime-600 dark:bg-lime-600 ">';
                            html += '<svg class="w-4 h-4 inline-block mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                            html += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
                            html += '</svg>';
                        } else if (row.payment_status == 'Pendiente') {
                            html += ' bg-yellow-500 dark:bg-yellow-600">';
                            html += '<svg class="w-4 h-4 inline-block mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">';
                            html += '<circle cx="12" cy="12" r="10" stroke-width="2" fill="none"></circle>';
                            html += '<path d="M12 6v6l4 2"></path>';
                            html += '</svg>';
                        } else if (row.payment_status == 'Cancelado') {
                            html += ' bg-red-500 dark:bg-red-600 text-white dark:text-white">';
                            html += '<svg class="w-4 h-4 inline-block mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                            html += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                            html += '</svg>';
                        }
                        html += row.payment_status + '</span></div>';
                        return html;
                    },
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).addClass('text-center');
                    }
                },
                {
                    render: function(data, type, row, meta) {
                        html = '<a href="{{route("employee.contract.show", ":employee_id")}}" class="text-xs text-black font-bold bg-gray-300 hover:button active:button button hover:text-white p-2 text-center rounded" >' +
                            'Ver detalle' +
                            '</a>';
                        html = html.replace(/:employee_id/g, row.id);
                        return html;
                    },
                },
                {
                    data: 'payment_method',
                    name: 'payment_method'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    render: function(data, type, row, meta) {
                        var baseId = row.id;
                        var editUrl = "{{ route('product.edit', ':id') }}";
                        editUrl = editUrl.replace(':id', baseId);
                        var html = ' <a href="{{route("product.edit", ":id")}}" style="border: none;" class="p-2 focus:outline-none focus:shadow-outline-gray editar text-sm font-medium leading-5 text-gray-700 hover:text-gray-900 transition-colors duration-150 dark:text-gray-400 rounded"><i class="fas fa-edit"></i></a>' +
                            '<button class="p-2 focus:outline-none focus:shadow-outline-gray eliminar text-sm font-medium leading-5 text-gray-700 hover:text-gray-900 transition-colors duration-150 dark:text-gray-400 rounded"  data-id="' + row.id + '"><i class="fas fa-trash-alt"></i></button>';
                        html = html.replace(/:id/g, row.id);
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
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
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
                filename: "Lista de Productos generado el " + day,
                title: "Detalles de Productos",
            }, {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                exportOptions: {
                    columns: ':not(.no-export)'
                },
                orientation: 'landscape', // Establecer la orientación a 'landscape'
                filename: "Lista de Productos generado el " + day,
                title: "Detalles de Productos",
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
                filename: "Lista de Productos generado el " + day,
                title: "Reporte generado el " + day,
            }, ],
            rowCallback: function(row, data, index) {
                $(row).css('background-color', 'transparent');
            }
        });
        $(document).on('click', '.eliminar', function() {
            var button = $(this);
            Swal.fire({
                title: 'Eliminar Pedido',
                text: '¿Está seguro de eliminar este registro?',
                icon: 'warning',
                input: 'password',
                inputPlaceholder: 'Ingrese su contraseña',
                showCancelButton: true,
                confirmButtonColor: '#ffc107', // Color amarillo
                cancelButtonColor: '#dc3545', // Color rojo
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar',
                preConfirm: (password) => {
                    if (!password) {
                        Swal.showValidationMessage('Debe ingresar su contraseña');
                    }
                    return password;
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    let password = result.value;
                    let id = $(this).attr('data-id');
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    $.get('{{ route("user.checkPassword", ":password") }}'.replace(':password', password), {
                            _token: csrfToken
                        })
                        .done(function(response) {
                            if (response.valid) {
                                var row = button.closest('tr');
                                deleteFila(id, row);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Contraseña incorrecta',
                                    text: 'La contraseña proporcionada es incorrecta.',
                                });
                            }
                        })
                        .fail(function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un error al verificar la contraseña.',
                            });
                        });
                }
            });
        });
        function deleteFila(id, row) {
            $.ajax({
                url: '{{ route("product.destroyed", ":id") }}'.replace(':id', id),
                type: 'DELETE',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se eliminó a ' + data.message + ' del registro',
                        showConfirmButton: false,
                        timer: 1500,
                        allowOutsideClick: false
                    }).then(function() {
                        t.row(row).remove().draw(false);
                    });
                }
            }).fail(function() {
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
        $(document).on('click', '#redirect', function() {
            var code = $(this).data('id');
            var url = "{{ route('barcode.generate-qr', ':code') }}";
            url = url.replace(':code', code);
            window.open(url, '_blank');
        });
</script>
@if(session('success') != null)
<script>
const Toast = Swal.mixin({
    toast: true,
    position: 'center',
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
// Eliminar la sesión 'success' después de mostrar el mensaje
    @php
    session()->forget('success');
    @endphp
</script>
@endif
@endsection