<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="xs:w-full xl:w-7/12 mx-auto py-4 px-4 sm:px-6 lg:px-4">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Detalles Usuario
                </h2>
                <a href="{{ route('users.index') }}"
                    class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-3 rounded inline-block text-center">Volver</a>
            </div>
        </div>
    </header>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div
                class="xs:w-full xl:w-7/12 mx-auto sm:px-6 lg:px-8 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-3 dark:border-gray-500">
                        Datos de {{ $user->full_name }}
                    </h4>
                    <ul class="mt-4 text-gray-700 flex flex-wrap">
                        <li class="flex w-full sm:w-1/4 py-3 px-3">
                            <label for="name" class="w-full dark:text-white">Nombre
                                <input type="text" name="name" id="name" value="{{ $user->name }}"
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500 text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                    readonly>
                            </label>
                        </li>
                        <li class="flex w-full sm:w-1/4 py-3 px-3">
                            <label for="first_lname" class="w-full dark:text-white">Primer Apellido
                                <input type="text" name="first_lname"
                                    id="first_lname"value="{{ $user->first_lname }}"
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                    readonly>
                            </label>
                        </li>
                        <li class="flex w-full sm:w-1/4 py-3 px-3">
                            <label for="second_lname" class="w-full dark:text-white">Segundo Apellido
                                <input type="text" name="second_lname" id="second_lname"
                                    value="{{ $user->second_lname }}"
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                    readonly>
                            </label>
                        </li>
                        <li class="flex w-full sm:w-1/4 py-3 px-3">
                            <label for="second_lname" class="w-full dark:text-white">Rol
                                <input type="text" name="second_lname" id="second_lname"
                                    value="{{ $user->roles->pluck('name')->implode(', ') }}"
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                    readonly>
                            </label>
                        </li>
                        <style>
                            .input-cursor {
                                cursor: pointer;
                            }
                        </style>
                        <li class="flex w-full sm:w-1/4 py-3 px-3">
                            <label for="email" class="w-full dark:text-white">Email
                                <input type="email" name="email" id="email" value="{{ $user->email }}"
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-green-500 font-bold dark:text-green-500 dark:bg-gray-700 dark:border-gray-600 input-cursor"
                                    readonly>
                            </label>
                        </li>
                        <script>
                            let email = document.getElementById('email');
                            email.addEventListener('click', function() {
                                window.open("mailto:" + email, "_blank");
                            });
                        </script>
                        <li class="flex w-full sm:w-1/4 py-3 px-3">
                            <label for="phone" class="w-full dark:text-white relative">
                                <span class="absolute left-0 top-6 mt-2 ml-4 input-cursor">
                                    <i class="fab fa-whatsapp text-green-500"></i>
                                </span>
                                Teléfono
                                <input type="text" name="phone" id="phone" value="{{ $user->formattedPhone }}"
                                    class="pl-10 px-1 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500 font-bold text-green-500 dark:text-green-500 dark:bg-gray-700 dark:border-gray-600 input-cursor"
                                    readonly>
                            </label>
                        </li>
                        <script>
                            let phone = document.getElementById('phone');
                            phone.addEventListener('click', function() {
                                phone = phone.value.replace(/ /g, "");
                                window.open("https://wa.me/+34" + phone, "_blank");
                            });
                        </script>
                        <li class="flex w-full sm:w-1/4 py-3 px-3">
                            <label for="created_at" class="w-full dark:text-white">Fecha de alta
                                <input type="text" name="created_at" id="created_at"
                                    value="{{ $user->formattedCreatedAt }}"
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                    readonly>
                            </label>
                        </li>
                        <li class="flex w-full sm:w-1/4 py-3 px-3">
                            <label for="created_by" class="w-full dark:text-white">Creado por:
                                <input type="text" name="created_by" id="created_by" value="{{ $user->created_by }}"
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                    placeholder="" readonly>
                                <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}"
                                    class="hidden px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                    readonly>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
