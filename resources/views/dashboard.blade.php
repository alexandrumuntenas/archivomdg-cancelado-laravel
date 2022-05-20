<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-flow-row-dense grid-cols-3 grid-rows-3">
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-2 space-y-2">
            <div class="space-y-1.5 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 grid grid-flow-row-dense grid-cols-3 grid-rows-3 space-x-3">
                    <div class="col-span-2 p-6 bg-white drop-shadow-md overflow-hidden sm:rounded-lg">
                        <p class="text-2xl">Navegador de archivos</p>
                    </div>
                    <div class="col-span-1 p-6 overflow-hidden sm:rounded-lg">
                        <p class="text-2xl">Próximos eventos</p>
                        <p class="text-center p-6" id="proximoeventos-spinner">
                            <span
                                class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full text-blue-600"
                                role="status">
                            </span>
                        </p>
                        <div id="proximoseventos-datos" class="min-w-full my-4 space-y-2">
                        </div>
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
                    $('#proximoseventos-datos').append(`
                        <div class="bg-white drop-shadow-md sm:rounded-lg px-6 py-4 text-gray-900 bg-white"><p class="text-base">${evento.nombre}  <span class="text-xs">${evento.fecha}</span></p></div>
                    `);
                });
                $('#proximoeventos-spinner').hide();
            }
        });
    </script>
</x-app-layout>
