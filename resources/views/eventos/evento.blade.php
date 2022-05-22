<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <div id="cargador-datos-evento"
                class="mr-4 spinner-border animate-spin inline-block w-6 h-6 border-2 rounded-full text-blue-600"
                role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight" id="evento-nombre">
                    Cargando datos...
                </h2>
                <span id="evento-fecha-y-hora" class="text-gray-500">
                </span>
                <div id="evento-lugar" class="text-gray-500">
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex space-x-2">
                <button type="button" id="eliminarevento"
                    class="inline-block px-6 py-2.5 bg-transparent text-red-600 font-medium text-xs leading-tight uppercase rounded hover:text-red-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out">Eliminar evento</button>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 pb-0 flex">
                    <div id="cargador-partituras-evento"
                        class="mr-4 spinner-border animate-spin inline-block w-6 h-6 border-2 rounded-full text-blue-600"
                        role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p>Haz click en una partitura para solicitar su descarga.</p>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 spac" id="partituras">

                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajax({
            url: '{{ route('obtenerEvento', $eventoID) }}',
            type: 'GET',
            dataType: 'json',
            success: function(evento) {
                evento.fechaYhora = moment(`${evento.fecha} ${evento.hora}`).format('HH:mm @ Do MMMM YYYY');
                $('#evento-nombre').text(evento.nombre);
                $('#evento-fecha-y-hora').text(evento.fechaYhora);
                $('#evento-lugar').text(evento.lugar);
                $('#cargador-datos-evento').hide();
            }
        });
        $.ajax({
            url: '{{ route('obtenerPartituras', $eventoID) }}',
            type: 'GET',
            dataType: 'json',
            success: function(partituras) {
                if (partituras.length > 0) {
                    partituras.forEach(function(partitura) {
                        $('#partituras').append(
                            `<button type="button" class="space-y-1 min-w-full inline-block px-6 py-2.5 bg-transparent text-gray-800 font-medium text-base text-left leading-tight rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out" partituraid="${partitura.id}">${partitura.archivo}</span></button>`
                        );
                    });
                } else {
                    $('#partituras').append(
                        `<button type="button" class="space-y-1 min-w-full inline-block px-6 py-2.5 bg-transparent text-gray-800 font-medium text-base text-left leading-tight rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out">No hay eventos programados</span></button>`
                    );
                }
                $('#cargador-partituras-evento').hide();
            }
        });
        $('#partituras').on('click', 'button', function() {
            if ($(this).attr('partituraid')) {
                window.open(
                    `{{ route('descargarPartitura') }}/${$(this).attr('partituraid')}/{{ Auth::user()->cuerda }}`,
                    '_blank');
            }
        });
        $('#eliminarevento').on('click', function() {
            $('#cargador-datos-evento').removeClass('text-blue-600');
            $('#cargador-datos-evento').addClass('text-red-600');
            $('#cargador-datos-evento').show();
            $.ajax({
                url: '{{ route('eliminarEvento') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: '{{ $eventoID }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(evento) {
                    window.location.href = '{{ route('verEventos') }}';
                }
            });
        });
    </script>
</x-app-layout>
