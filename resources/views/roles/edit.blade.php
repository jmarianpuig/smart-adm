<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="xs:w-full xl:w-7/12 mx-auto py-4 px-4 sm:px-6 lg:px-4">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Editar Rol {{ $role->name }}
                </h2>
                <a href="{{ route('roles.index') }}"
                    class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-3 rounded inline-block text-center">Volver</a>
            </div>
        </div>
    </header>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-4">
            <div
                class="xs:w-full xl:w-7/12 mx-auto sm:p-6 lg:p-8 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4 mt-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between">
                            <p
                                class="text-xl text-gray-900 dark:text-white font-bold border-b py-3 dark:border-gray-500 mb-4 w-full">
                                ¡Atención!
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-900 dark:text-white py-3 dark:border-gray-500 mb-4 w-full">
                                La modificación de un permiso es global y afecta todos los usuarios con ese rol, si necesita añadir/quitar un permiso específico utilice las opciones en usuarios.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full mx-auto sm:px-6 lg:px-4">
            <div
                class="xs:w-full xl:w-7/12 mx-auto sm:px-6 lg:px-8 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4 mt-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between">
                            <h4
                                class="text-xl text-gray-900 dark:text-white font-bold border-b py-3 dark:border-gray-500 mb-4 w-full">
                                Permisos de {{ $role->name }}
                                
                                {{-- <a href="{{ route('roles.create') }}"
                                    class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-2 px-3 rounded inline-block text-center mx-auto float-right"><i
                                        class="fa-solid fa-file-excel"></i> Seleccionados</a> --}}
                            </h4>
                        </div>
                        @php
                            $roleId = $role->id;
                        @endphp
                        <livewire:permissions-edit-table :role='$roleId' />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
