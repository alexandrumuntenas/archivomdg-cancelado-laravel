<x-app-layout>
    <x-slot name="header">
        <p class="text-2xl"><span id="evento-data-nombre">{{ $evento['nombre'] }}</span> <span
                class="text-base" id="evento-data-fecha-relativo"></span></p>
        <span
            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded"><i
                class="fas fa-calendar-day"></i> <span id="evento-data-fecha"></span></span>
        <span
            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded"><i
                class="fas fa-clock"></i> <span id="evento-data-hora"></span></span>
        <span
            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded"><i
                class="fas fa-compass"></i> <span id="evento-data-ubicacion">{{ $evento['ubicacion'] }}</span></span>
    </x-slot>

    <div class="py-12">
        <div class="mx-2 space-y-2">
            <div class="space-y-1.5 max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                @can('eventos-edit')
                    <form id="editarevento" class="p-6 bg-white drop-shadow-md overflow-hidden sm:rounded-lg"
                        action="{{ route('editarEvento', $evento['id']) }}" method="POST">
                        @csrf
                        <div class="space-y-3">
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="nombre">
                                        Nombre
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="nombre" name="nombre" type="text" value="{{ $evento['nombre'] }}">
                                </div>
                                <div class="mt-6 w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="fecha">
                                        Fecha
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="fecha" name="fecha" type="date" value="{{ $evento['fecha'] }}">
                                </div>
                                <div class="mt-6 w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="hora">
                                        Hora
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="hora" name="hora" type="time" value="{{ $evento['hora'] }}">
                                </div>
                                <div class="mt-6 w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="ubicacion">
                                        Ubicación
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="ubicacion" name="ubicacion" type="text" value="{{ $evento['ubicacion'] }}">
                                </div>
                            </div>
                            <input type="submit" value="Actualizar"
                                class="inline-block px-6 py-2.5 bg-blue-500 text-white font-medium text-xs leading-tight uppercase rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700" />
                            @can('eventos-delete')
                                <button type="button"
                                    class="inline-block px-6 py-2.5 bg-transparent text-red-600 font-medium text-xs leading-tight uppercase rounded hover:text-red-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out">Eliminar
                                    evento</button>
                            @endcan
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>
    <script>
        $('#evento-data-fecha-relativo').text(moment("{{ $evento['fecha'] }}", "YYYYMMDD").fromNow());
        $('#evento-data-fecha').text(moment("{{ $evento['fecha'] }}", "YYYYMMDD").format("DD/MM/YYYY"));
        $('#evento-data-hora').text(moment("{{ $evento['hora'] }}", "HH:mm").format("HH:mm"));
        $.ajax({
            url: "{{ route('archivos', $evento['id']) }}",
            type: 'GET',
            dataType: 'json',
            success: function(archivos) {
                try {
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

        $('#editarevento').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('editarEvento', $evento['id']) }}",
                type: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (false) {
                        $('#evento-data-fecha-relativo').text(moment("{{ $evento['fecha'] }}",
                            "YYYYMMDD").fromNow());
                        $('#evento-data-fecha').text(moment("{{ $evento['fecha'] }}", "YYYYMMDD")
                            .format("DD/MM/YYYY"));
                        $('#evento-data-nombre').text(data.nombre);
                        $('#evento-data-hora').text(moment("{{ $evento['hora'] }}", "HH:mm").format(
                            "HH:mm"));
                        $('#evento-data-ubicacion').text(data.ubicacion);
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true,
                            icon: 'error',
                            title: 'Error al actualizar el evento'
                        })
                    }
                },
            });
        });
    </script>
</x-app-layout>
