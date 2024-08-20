<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Figurantes Menores de 16 años
        </h2>
    </x-slot>

    <div class="pt-8 pb-4">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
                        Figurantes
                    </h2>
                    <livewire:younger-table :type='$modelType' />
                </div>
            </div>
        </div>
    </div>

    @can('deleted.youngers.extras')
        <div class="py-4">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="font-semibold text-xl text-red-800 dark:text-red-500 leading-tight mb-4">
                            Eliminados
                        </h2>
                        <livewire:younger-removed-table :type='$modelType' />
                    </div>
                </div>
            </div>
        </div>
    @endcan

</x-app-layout>
