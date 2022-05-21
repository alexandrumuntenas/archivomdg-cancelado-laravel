<x-app-layout>
    <x-slot name="header">
        <p class="text-2xl">{{ $evento['nombre'] }} <span class="text-base" id="evento-fecha"></span></p>
        <span
            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded"><i
                class="fas fa-calendar-day"></i> {{ $evento['fecha'] }}</span>
        <span
            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded"><i
                class="fas fa-clock"></i> {{ $evento['hora'] }}</span>
        <span
            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded"><i
                class="fas fa-compass"></i> {{ $evento['ubicacion'] }}</span>
    </x-slot>

    <div class="py-12">
        <div class="mx-2 space-y-2">
            <div class="space-y-1.5 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    @can('eventos-edit')
                        <button type="button"
                            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Editar
                            evento</button>
                    @endcan
                    @can('eventos-delete')
                        <button type="button"
                            class="inline-block px-6 py-2.5 bg-transparent text-red-600 font-medium text-xs leading-tight uppercase rounded hover:text-red-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out">Eliminar
                            evento</button>
                    @endcan
                </div>
                <div class="p-6 bg-white drop-shadow-md overflow-hidden sm:rounded-lg">
                    <p class="text-center p-6" id="files-spinner">
                        <span
                            class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full text-blue-600"
                            role="status">
                        </span>
                    </p>
                    <div id="files-datos" class="min-w-full my-4 space-y-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#evento-fecha').text(moment("{{ $evento['fecha'] }}", "YYYYMMDD").fromNow());
        $.ajax({
            url: "{{ route('archivos', $evento['id']) }}",
            type: 'GET',
            dataType: 'json',
            success: function(archivos) {
                try {
                    archivos = archivos.filter(archivo => {
                        archivo.split('_')[1] == "{{ 'percusion' }}";
                    })
                    if (archivos.length > 0) {
                        archivos.forEach(archivo => {
                            archivo = archivo.split('/')[1];
                            $('#files-datos').append(`
                                <button archivo="${archivo}" class="min-w-full px-6 py-2.5 bg-transparent text-gray-900 font-medium text-xs rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out"><p class="text-base text-left">
                                        <i class="fa-solid fa-file-arrow-down"></i> ${archivo}
                                    </p>
                                </button>
                            `);
                        });
                    } else {
                        // no hay archivos disponibles
                        $('#files-datos').append(`
                            <button class="min-w-full px-6 py-2.5 bg-transparent text-gray-900 font-medium text-xs rounded hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out">
                                <p class="text-base text-left">
                                    <i class="fa-solid fa-file-circle-exclamation"></i> No hay archivos disponibles
                                </p>
                            </button>
                        `);
                    }
                } finally {
                    $('#files-spinner').hide();
                }
            },
        });
        $('#files-datos').on('click', 'button', function() {
            if ($(this).attr('archivo') != undefined) {
                window.open(`{{ route('descargarArchivo', $evento['id']) }}/${$(this).attr('archivo')}`,
                    '_blank');
            }
        });
    </script>
</x-app-layout>
