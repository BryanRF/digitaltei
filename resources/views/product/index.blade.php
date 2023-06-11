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
        <div class="w-full overflow-x-auto ">
            <table class="w-full whitespace-no-wrap display">
                <thead>
                    <tr class="text-xs  font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3 no-export">Imagen</th>
                        <th class="px-4 py-3">Codigo de Barra</th>
                        <th class="px-4 py-3">Descripción </th>
                        <th class="px-4 py-3">Precio </th>
                        <th class="px-4 py-3">Presentación</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Marca</th>
                        <th class="px-4 py-3">Subcategoría</th>
                        <th class="px-4 py-3">Imagenes</th>
                        <th class="px-4 py-3 text-center no-export">Opciones</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg relative">
            <button id="closeModal" class="button hover:button active:button dark:button absolute top-0 right-0 mt-4 mr-4 text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" src="" alt="Imagen" class="h-80 w-full object-cover rounded">
            <p id="imageName" class="mt-4 text-center"></p>
        </div>
    </div>

</div>
    <style>
        #imageModal {
            display: none;
            background-color: rgba(0, 0, 0, 0.5);
        }
        #imageModal.visible {
            display: flex;
        }
        #imageModal .bg-white {
            background-color: #fff;
        }
        #imageModal.dark .bg-white {
            background-color: #1f2937;
        }
        #imageModal .rounded-lg {
            border-radius: 0.5rem;
        }
        #imageModal .p-6 {
            padding: 1.5rem;
        }
        #imageModal .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        #imageModal .h-80 {
            height: 20rem;
        }
        #imageModal .w-full {
            width: 100%;
        }
        #imageModal .object-cover {
            object-fit: cover;
        }
        #imageModal .rounded {
            border-radius: 0.25rem;
        }
    </style>
    <script>
        const imageModal = document.getElementById('imageModal');
        $(document).on('click', '.openModal', function() {
            const modalImage = document.getElementById('modalImage');
            const imageName = document.getElementById('imageName');
            // Obtener la URL de la imagen del atributo 'data-image'
            const imageUrl = this.getAttribute('data-image');
            const name = this.getAttribute('data-name');
            // Establecer la imagen y el nombre en el modal
            modalImage.setAttribute('src', imageUrl);
            imageName.textContent = name;
            // Mostrar el modal
            imageModal.classList.add('visible');
        });
        document.getElementById('closeModal').addEventListener('click', function() {
        // Ocultar el modal
        imageModal.classList.remove('visible');
    });
    </script>
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
            ajax: "{{route('datatable.product')}}",
            columns: [{
                    render: function(data, type, row, meta) {
                        html ='<p class="font-semibold">' + row.name + '</p>';
                        return html;
                    }
                },
                {
                    render: function(data, type, row, meta) {
                        html = '<button data-name="'+row.name+'" data-image="{{ Storage::url(":image") }}" class=" openModal text-blue-500"><img class="h-20 object-cover w-full h-10 rounded" src="{{ Storage::url(":image") }}"/>'+
                        '</button>';
                        return html.replace(/:image/g, row.image);
                    },
                },
                {
                    render: function(data, type, row, meta) {
                        var generateQrRoute = "{{route('barcode.generate', ':code')}}";
                        return '<td class="px-4 py-3 text-sm">' +
                            '<button class=" button px-2 py-2 text-xs font-semibold hover:button active:button dark:button leading-tight rounded " onclick="copyText(\'' + row.code + '\')" title="Copiar"><img src="' + generateQrRoute.replace(':code', row.id) + '" alt="Barcode">' + '<p hidden>' + row.code + '</p>' + '</button>' +
                            '</td>'.replace(/:code/g, row.code);
                    },
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'presentation',
                    name: 'presentation'
                },
                {
                    render: function(data, type, row, meta) {
                        return '<td class="px-4 py-3 text-sm">' +
                            '<span class="px-2 py-1 text-xs font-semibold rounded ' + (row.status ? 'bg-lime-600 dark:bg-lime-600  ' : 'bg-red-500 dark:bg-red-600 text-white dark:text-white ') + '">' +
                            (row.status ? 'Activo' : 'Inactivo') +
                            '</span>' +
                            '</td>';
                    },
                },
                {
                    data: 'brand.name',
                    name: 'brand.name'
                },
                {
                    data: 'sub_category.name',
                    name: 'sub_category.name'
                },

                {
                    render: function(data, type, row, meta) {
                        var html = ' <a href="{{route("image.create", ":id")}}" style="border: none;" class="p-2 focus:outline-none focus:shadow-outline-gray editar text-sm font-medium leading-5 text-gray-700 hover:text-gray-900 button hover:button transition-colors duration-150 dark:text-gray-900 rounded">Ver galeria <i class="fa fa-picture-o" aria-hidden="true"></i></a>' ;
                        html = html.replace(/:id/g, row.id);
                        return html;
                    }
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
                title: 'Eliminar Producto',
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
        @php
        session()->forget('success');
        @endphp
    </script>
    @endif
@endsection