<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <div id="cargador-eventos"
                class="mr-4 spinner-border animate-spin inline-block w-6 h-6 border-2 rounded-full text-blue-600"
                role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mis eventos') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 spac" id="eventos">
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajax({
            url: '{{ route('obtenerEventosDelUsuario') }}',
            type: 'GET',
            dataType: 'json',
            success: function(eventos) {
                if (eventos.length > 0) {
                    eventos.forEach(function(evento) {
                        evento.tiemporelativo = moment(evento.fecha).fromNow();
                        $('#eventos').append(
                            `<button type="button" class="space-y-1 min-w-full inline-block px-6 py-2.5 bg-transparent text-gray-800 font-medium text-base text-left leading-tight rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out" eventoid="${evento.id}">${evento.nombre} <span class="text-xs">${evento.tiemporelativo}</span></button>`
                        );
                    });
                } else {
                    $('#eventos').append(
                        `<button type="button" class="space-y-1 min-w-full inline-block px-6 py-2.5 bg-transparent text-gray-800 font-medium text-base text-left leading-tight rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out">No hay eventos programados</span></button>`
                    );
                }
                $('#cargador-eventos').hide();
            }
        });
        $('#eventos').on('click', 'button', function() {
            if ($(this).attr('eventoid')) {
                window.location.href = `{{ route('verEvento') }}/${$(this).attr('eventoid')}`;
            }
        });
    </script>
</x-app-layout>
