<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900">
            Hola, {{ Auth::user()->name }} 👋
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-2 space-y-2">
            <div class="space-y-1.5 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    @can('eventos-create')
                        <button type="button"
                            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Crear
                            evento</button>
                    @endcan
                </div>
                <div class="p-6 bg-white drop-shadow-md overflow-hidden sm:rounded-lg">
                    <p class="text-2xl">Eventos programados</p>
                    <p class="text-center p-6" id="eventos-spinner">
                        <span
                            class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full text-blue-600"
                            role="status">
                        </span>
                    </p>
                    <div id="eventos-datos" class="min-w-full my-4 space-y-2">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajax({
            url: '{{ route('eventos') }}',
            type: 'GET',
            success: eventos => {
                if (eventos) eventos.forEach(evento => {
                    evento.fecha = moment(evento.fecha, "YYYYMMDD").fromNow();
                    $('#eventos-datos').append(`
                        <button eventoid="${evento.id}" class="min-w-full px-6 py-2.5 bg-transparent text-gray-900 font-medium text-xs rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out"><p class="text-base text-left">
                            ${evento.nombre}
                            <span class="text-xs">${evento.fecha}</span></p>
                        </button>
                    `);
                });
                $('#eventos-spinner').hide();
            }
        });

        $('#eventos-datos').on('click', 'button', function() {
            window.location.href = `{{ route('verEvento') }}/${$(this).attr('eventoid')}`;
        });
    </script>
</x-app-layout>
