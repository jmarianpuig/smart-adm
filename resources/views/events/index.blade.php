<x-app-layout>

    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="xs:w-full xl:w-7/12 mx-auto py-4 px-4 sm:px-6 lg:px-4">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Eventos TV
                </h2>
                @can('events.create')
                    <a href="{{ route('events.create') }}"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded inline-block text-center">Crear
                        Nuevo Evento</a>
                @endcan
            </div>
        </div>
    </header>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div
                class="xs:w-full xl:w-7/12 mx-auto sm:px-6 lg:px-8 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <livewire:event-table />
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
