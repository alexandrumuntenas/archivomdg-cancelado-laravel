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
                    <div class="col-span-1 p-6 bg-white drop-shadow-md overflow-hidden sm:rounded-lg">
                        <p class="text-2xl">Próximos eventos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
