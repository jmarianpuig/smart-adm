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
                class="xs:w-full xl:w-7/12 mx-auto sm:px-6 lg:px-8 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4 mt-8">
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
                                El nuevo rol se creará con solo con el permiso de ver el Panel de Control, una vez creado hay que asignarle los permisos
                                restantes.
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

                        </div>
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <h4
                                class="text-xl text-gray-900 dark:text-white font-bold border-b py-3 dark:border-gray-500">
                                Crear Nuevo Rol
                            </h4>
                            <ul class="mt-4 text-gray-700 flex flex-wrap">
                                <li class="flex w-full sm:w-1/2 py-3 px-3">
                                    <label for="name" class="w-full dark:text-white">Nombre del Rol
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                            placeholder="Nombre del Rol" required>
                                    </label>
                                </li>
                                <li class="flex w-full sm:w-1/2 py-3 px-3">
                                    <label for="description" class="w-full dark:text-white">Descripción del Rol
                                        <input type="text" name="description" id="description" value="{{ old('description') }}"
                                            class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                            placeholder="Descripción del Rol" required>
                                    </label>
                                </li>
                                <li class="w-full flex justify-center mt-5">
                                    {{--  Submit --}}
                                    <button type="submit"
                                        class="max-w-[140px] mx-3 py-2 px-4 flex justify-center items-center  bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg ">
                                        <svg width="20" height="20" fill="currentColor" class="mr-2"
                                            viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1344 1472q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm256 0q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm128-224v320q0 40-28 68t-68 28h-1472q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h427q21 56 70.5 92t110.5 36h256q61 0 110.5-36t70.5-92h427q40 0 68 28t28 68zm-325-648q-17 40-59 40h-256v448q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-448h-256q-42 0-59-40-17-39 14-69l448-448q18-19 45-19t45 19l448 448q31 30 14 69z">
                                            </path>
                                        </svg>
                                        Guardar
                                    </button>
                                    {{--  Submit --}}
                                    <a href="{{ route('roles.index') }}"
                                        class="max-w-[140px] mx-3 py-2 px-4 flex justify-center items-center  bg-teal-600 hover:bg-teal-700 focus:ring-teal-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">Cancelar
                                    </a>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
