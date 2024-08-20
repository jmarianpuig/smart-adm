<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar {{ $data->full_name }}
        </h2>
    </x-slot>
    <div class="w-full mx-auto sm:px-6 lg:px-4">
        <div
            class="xs:w-full xl:w-7/12 mx-auto sm:p-6 lg:p-6 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4 mt-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white  dark:bg-gray-700 dark:text-white rounded-lg shadow-xl pb-8">
                    <livewire:head-profile :info="$data" :key="$data->id" :url="'https://smartfiguracion.es/public/images/actors/avatars/'" />
                    <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
                        <livewire:actions-profile :info="$data" :key="$data->id" />
                    </div>
                </div>
                {{-- componente del profile de la pagina show --}}
                @component('components.extra-update-form')
                    @slot('data', $data)
                @endcomponent

            </div>
        </div>
    </div>
</x-app-layout>
