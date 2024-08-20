<x-app-layout>

    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="xs:w-full xl:w-7/12 mx-auto py-4 px-4 sm:px-6 lg:px-4">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Usuarios
                </h2>
                <a href="{{ route('users.create') }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded inline-block text-center" >Crear Nuevo Usuario</a>
            </div>
        </div>
    </header>

    <div class="pt-8 pb-4">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="xs:w-full xl:w-7/12 mx-auto sm:px-6 lg:px-8 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
                        Usuarios Activos
                    </h2>
                    <livewire:users-table />
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-4">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="xs:w-full xl:w-7/12 mx-auto sm:px-6 lg:px-8 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-red-800 dark:text-red-200 leading-tight mb-4">
                        Usuarios Eliminados
                    </h2>
                    <livewire:users-removed-table />
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
