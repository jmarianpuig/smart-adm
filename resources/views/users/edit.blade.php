<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="xs:w-full xl:w-7/12 mx-auto py-4 px-4 sm:px-6 lg:px-4">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $user->full_name }}
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
                    <form id="updateUser" method="POST" action="{{ route('users.update', $user->id) }}" role="form"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf

                        <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-3 dark:border-gray-500">
                            Modificar Usuario
                        </h4>
                        <ul class="mt-4 text-gray-700 flex flex-wrap">
                            <li class="flex w-full sm:w-1/4 py-3 px-3">
                                <label for="name" class="w-full dark:text-white">Nombre *
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name') ?: $user->name }}" minlength="3" maxlength="30"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500 text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        onkeypress="return soloLetrasConEspacios(event)"
                                        onkeyup="this.value = this.value.toUpperCase();"
                                        placeholder="Nombre del usuario" required>
                                </label>
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                            <li class="flex w-full sm:w-1/4 py-3 px-3">
                                <label for="first_lname" class="w-full dark:text-white">Primer Apellido *
                                    <input type="text" name="first_lname" id="first_lname"
                                        value="{{ old('first_lname') ?: $user->first_lname }}" minlength="3"
                                        maxlength="30"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        onkeypress="return soloLetrasConEspacios(event)"
                                        onkeyup="this.value = this.value.toUpperCase();" placeholder="Primer Apellido"
                                        required>
                                </label>
                                @error('first_lname')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                            <li class="flex w-full sm:w-1/4 py-3 px-3">
                                <label for="second_lname" class="w-full dark:text-white">Segundo Apellido
                                    <input type="text" name="second_lname" id="second_lname"
                                        value="{{ old('second_lname') ?: $user->second_lname }}" minlength="3"
                                        maxlength="30"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        onkeypress="return soloLetrasConEspacios(event)"
                                        onkeyup="this.value = this.value.toUpperCase();" placeholder="Segundo Apellido">
                                </label>
                                @error('second_lname')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                            {{-- full_name (oculto) --}}
                            <input type="hidden" name="full_name" value="{{ $user->full_name }}">
                            <li class="flex w-full sm:w-1/4 py-3 px-3">
                                <label for="role" class="w-full dark:text-white">Rol *
                                    <select name="role" id="role"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ old('role', $userRoleId) == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </li>
                            <li class="flex w-full sm:w-1/4 py-3 px-3">
                                <label for="email" class="w-full dark:text-white">Email *
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email') ?: $user->email }}"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        placeholder="Email" required>
                                </label>
                            </li>
                            @error('email')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <li class="flex w-full sm:w-1/4 py-3 px-3">
                                <label for="phone" class="w-full dark:text-white">Teléfono *
                                    <input type="text" name="phone" id="phone" pattern="[0-9]{9}"
                                        maxlength="9" value="{{ old('phone') ?: $user->phone }}"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        placeholder="Teléfono" required>
                                </label>
                            </li>
                            <li class="flex w-full sm:w-1/4 py-3 px-3">
                                <label for="password" class="w-full dark:text-white">Contraseña *
                                    <input type="password" name="password" id="password" value="" minlength="8"
                                        maxlength="15"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:invalid:border-red-500 focus:valid:border-green-500  text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        placeholder="Contraseña">
                                </label>
                            </li>
                            <li class="flex w-full sm:w-1/4 py-3 px-3">
                                <label for="created_by" class="w-full dark:text-white">Creado por:
                                    <input type="text" name="created_by" id="created_by"
                                        value="{{ Auth::user()->fullName }}"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        placeholder="Creado por" readonly>
                                    <input type="text" name="created_by_id" id="created_by_id"
                                        value="{{ Auth::user()->id }}"
                                        class="hidden px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                        placeholder="" readonly>
                                </label>
                            </li>
                            <li class="w-full flex justify-center mt-5">
                                {{--  Submit --}}
                                <button type="submit"
                                    class="max-w-[140px] mx-4 py-2 px-4 flex justify-center items-center  bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                    <svg width="20" height="20" fill="currentColor" class="mr-2"
                                        viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1344 1472q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm256 0q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm128-224v320q0 40-28 68t-68 28h-1472q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h427q21 56 70.5 92t110.5 36h256q61 0 110.5-36t70.5-92h427q40 0 68 28t28 68zm-325-648q-17 40-59 40h-256v448q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-448h-256q-42 0-59-40-17-39 14-69l448-448q18-19 45-19t45 19l448 448q31 30 14 69z">
                                        </path>
                                    </svg>
                                    Guardar
                                </button>
                                {{--  Submit --}}
                                <a href="{{ route('users.index') }}"
                                    class="max-w-[140px] py-2 px-4 flex justify-center items-center  bg-teal-600 hover:bg-teal-700 focus:ring-teal-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">Cancelar</a>
                            </li>
                        </ul>
                        <script>
                            function soloLetrasConEspacios(event) {
                                var keyCode = event.keyCode || event.which;
                                var char = event.key;

                                if ((keyCode >= 65 && keyCode <= 90) || // Letras mayúsculas
                                    (keyCode >= 97 && keyCode <= 122) || // Letras minúsculas
                                    keyCode == 32 || // Espacio
                                    keyCode == 225 || // á
                                    keyCode == 233 || // é
                                    keyCode == 237 || // í
                                    keyCode == 243 || // ó
                                    keyCode == 250 || // ú
                                    keyCode == 252 || // ü
                                    keyCode == 241 || // ñ
                                    keyCode == 193 || // Á
                                    keyCode == 201 || // É
                                    keyCode == 205 || // Í
                                    keyCode == 211 || // Ó
                                    keyCode == 218 || // Ú
                                    keyCode == 220 || // Ü
                                    keyCode == 209) { // Ñ
                                    return true;
                                }
                                return false;
                            }

                            const form = document.getElementById('updateUser');
                            const inputs = document.querySelectorAll('form [name][required]');

                            inputs.forEach(input => {
                                input.addEventListener('keyup', function() {
                                    if (this.validity.valid) {
                                        this.classList.remove('invalid:border-red-500');
                                        this.classList.add('valid:border-green-500');
                                    } else {
                                        this.classList.remove('valid:border-green-500');
                                        this.classList.add('invalid:border-red-500');
                                    }
                                });
                            });
                        </script>


                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
