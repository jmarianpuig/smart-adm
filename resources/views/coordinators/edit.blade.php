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
                <div class="my-4">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
                    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
                    <style>
                        input,
                        select {
                            border: none;
                            border-bottom: 0.5px solid teal !important;
                            padding-left: 5px !important;
                        }

                        input:focus,
                        select:focus {
                            border: none;
                            border-bottom: 0.5px solid rgb(216, 72, 15) !important;

                        }
                    </style>

                    @php
                        $route = match (get_class($data)) {
                            App\Models\Coordinator::class => 'coordinators.update',
                        };

                        if ($errors->any()) {
                            $errorMessage = '¡Hay errores en el formulario: ' . implode(', ', $errors->all());
                            toastr()->error($errorMessage, 'Error');
                        }
                    @endphp

                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <form class="grid gap-4 sm:grid-cols-1 md:grid-cols-2" action="{{ route($route, $data->id) }}"
                        method="POST" enctype="multipart/form-data" id="register">
                        @csrf
                        @method('patch')

                        {{-- id_user (oculto) --}}
                        <input type="hidden" name="user_id" value="{{ $data->user_id }}">

                        <div class="h-fit bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4">
                            <div class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4">
                                <h4
                                    class="text-xl text-gray-900 dark:text-white font-bold border-b py-2 dark:border-gray-500">
                                    Datos Personales</h4>
                                <ul class="mt-2 text-gray-700">
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>

                                    {{-- Name --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Nombre:</span>
                                        <input type="text" name="name"
                                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                            value="{{ $data->name }}" minlength="5" maxlength="30" required />
                                    </li>

                                    {{-- first_lname --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Apellido
                                            1:</span>
                                        <input type="text" name="first_lname"
                                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                            value="{{ $data->first_lname }}" minlength="5" maxlength="30" required />
                                    </li>

                                    {{-- second_lname --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Apellido
                                            2:</span>
                                        <input type="text" name="second_lname"
                                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                            value="{{ $data->second_lname }}" minlength="5" maxlength="30" />
                                    </li>

                                    {{-- Birthdate --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Fec.
                                            Nac.:</span>
                                        <input
                                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                            type="text" name="birthdate" id="birthdate"
                                            value="{{ $data->birthdate }}" data-input placeholder="Fecha de nacimiento"
                                            required />
                                    </li>
                                    @error('birthdate')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <script>
                                        // Form Picker
                                        'use strict';

                                        (function() {
                                            const flatpickrDate = document.getElementById('birthdate');
                                            if (flatpickrDate) {
                                                flatpickrDate.flatpickr({
                                                    monthSelectorType: 'static',
                                                    locale: 'es',
                                                    altInput: true,
                                                    altFormat: "d-m-Y",
                                                    dateFormat: "Y-m-d",
                                                    allowInput: true,
                                                });
                                            }
                                        })();
                                    </script>

                                    {{-- DNI/CIF --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">DNI/NIE:</span>
                                        <input type="text" name="dni" id="dni" value="{{ $data->dni }}"
                                            placeholder="Falta DNI/NIF" minlength="9" maxlength="9"
                                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                            onblur="validateDNI(this.value)" required />
                                    </li>
                                    @error('dni')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <script>
                                        function validateDNI(dni) {
                                            var x = document.getElementById("dni").value;
                                            document.getElementById("dni").value = x.toUpperCase();
                                            var numero, let1, letra;
                                            var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;

                                            dni = dni.toUpperCase();

                                            if (expresion_regular_dni.test(dni) === true) {
                                                numero = dni.substr(0, dni.length - 1);
                                                numero = numero.replace('X', 0);
                                                numero = numero.replace('Y', 1);
                                                numero = numero.replace('Z', 2);
                                                let1 = dni.substr(dni.length - 1, 1);
                                                numero = numero % 23;
                                                letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
                                                letra = letra.substring(numero, numero + 1);
                                                if (letra !=
                                                    let1) {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error en DNI/NIE',
                                                        html: '</br><b style="color: red">EL DNI/NIE no es correcto</b>',
                                                        allowOutsideClick: false,
                                                        showConfirmButton: true,
                                                    });
                                                    // Limpiar el campo del DNI
                                                    document.getElementById("dni").value = "";
                                                    return false;
                                                } else {
                                                    return true;
                                                }
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error en DNI/NIE',
                                                    html: '</br><b style="color: red">EL DNI/NIE tiene un formato incorrecto</b>',
                                                    allowOutsideClick: false,
                                                    showConfirmButton: true,
                                                });
                                                document.getElementById("dni").value = "";
                                                return false;
                                            }
                                        }
                                    </script>

                                    {{-- Seg.Soc --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Nº
                                            Seg.Soc.</span>
                                        <input type="text" name="ss"
                                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                            onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
                                            placeholder="Falta Nº Seg.Soc." value="{{ $data->ss }}" minlength="12"
                                            maxlength="12" />
                                    </li>
                                    {{-- Experience --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Experiencia:</span>
                                        <select name="experience"
                                            class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                                            <option
                                                class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                                value="{{ $data->experience }}" selected="selected">
                                                {{ $data->formattedExperience }}</option>
                                            <option
                                                class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                                value="0">No</option>
                                            <option
                                                class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                                value="1">Sí</option>
                                        </select>
                                    </li>
                                    @error('experience')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    {{-- Availability --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Disp.:</span>
                                        <select name="move_to_work_id"
                                            class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                                            @php
                                                $distances = \App\Models\MoveToWork::all();

                                            @endphp
                                            <option
                                                class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                                value="{{ $data->move_to_work_id }}" selected="selected">
                                                {{ $data->move_to_work->distance }}</option>
                                            @foreach ($distances as $distance)
                                                <option
                                                    class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                                    value="{{ $distance->id }}">{{ $distance->distance }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @error('move_to_work_id')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    {{-- Has car --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Coche:</span>
                                        <select name="has_car"
                                            class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                                            <option
                                                class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                                value="{{ $data->has_car }}" selected="selected">
                                                {{ $data->formattedHasCar }}</option>
                                            <option
                                                class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                                value="0">No</option>
                                            <option
                                                class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                                value="1">Sí</option>
                                        </select>
                                    </li>
                                    @error('has_car')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    {{-- Files --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Docs.:</span>
                                        <span><button name="file1" data-name="file1" type="button"
                                                onclick="importFile('file1')"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cambiar
                                                CV</button></span>
                                        <input name="file1" type="file" class="hidden" accept=".pdf">
                                    </li>
                                    <li class="flex py-2">
                                        <span id="file1Name"
                                            class="text-gray-700 dark:text-white text-clip overflow-hidden text-wrap"></span>
                                    </li>
                                    @error('file1')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </ul>
                            </div>
                            <div
                                class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4 mt-4">
                                <h4
                                    class="text-xl text-gray-900  dark:text-white font-bold border-b py-2 dark:border-gray-500">
                                    Datos de Contacto</h4>
                                <ul class="mt-2 text-gray-700">

                                    {{-- Phone --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Teléfono:</span>
                                        <div class="pointer-events-none inset-y-0 left-0 flex items-center pr-2">
                                            <span class="text-gray-700 dark:text-gray-300">(34)</span>
                                        </div>
                                        <input type="text"
                                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                            minlength="9" maxlength="9" name="phone"
                                            onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
                                            value="{{ $data->phone }}" required />
                                    </li>
                                    @error('phone')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    {{-- Email --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Email:</span>
                                        <span class="text-gray-700 dark:text-gray-300">{{ $data->user->email }}</span>
                                    </li>

                                    {{-- Adress --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Dirección:</span>
                                        <input type="text" name="adress"
                                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                            value="{{ $data->adress }}" minlength="5" maxlength="80" />
                                    </li>
                                    @error('adress')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    {{-- Zip Code --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">C.
                                            Postal:</span>
                                        <input type="text" name="zip_code"
                                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                            value="{{ $data->zip_code }}"
                                            onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
                                            minlength="5" maxlength="5" />
                                    </li>
                                    @error('zip_code')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    {{-- Provincias --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Provincia:</span>
                                        <select name="provincia" id="provincia"
                                            class="w-full py-0 h-6 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                            onchange="getMunicipios()">
                                            @php
                                                $provincias = \App\Models\Provincia::orderBy('provincia')->get();
                                            @endphp
                                            <option
                                                class="text-gray-700 dark:text-white dark:bg-gray-700 focus:ring-transparent"
                                                value="{{ $data->municipio->provincia->id }}" selected="selected">
                                                {{ $data->municipio->provincia->provincia }}</option>
                                            @foreach ($provincias as $provincia)
                                                <option
                                                    class="text-gray-700 dark:text-white dark:bg-gray-700 focus:ring-transparent"
                                                    value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @error('provincia')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    {{-- Municipios --}}
                                    <li class="flex py-2">
                                        <span
                                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Municipio:</span>
                                        <select name="municipio" id="municipio"
                                            class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                                            @php
                                                $municipios = \App\Models\Municipio::All();
                                            @endphp
                                            <option
                                                class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                                                value="{{ $data->municipio->id }}" selected="selected">
                                                {{ $data->municipio->municipio }}</option>
                                        </select>
                                    </li>
                                    @error('municipio')
                                        <span class="text-sm text-red-700">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </ul>
                            </div>
                            <script>
                                // Rellenar select de municipios
                                function getMunicipios() {
                                    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                    let provinciaId = document.getElementById('provincia').value;

                                    fetch("{{ route('getMunicipios') }}", {
                                            headers: {
                                                "Content-Type": "application/json",
                                                "X-CSRF-TOKEN": token
                                            },
                                            method: 'POST',
                                            body: JSON.stringify({
                                                provincia: provinciaId,
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {

                                            let html =
                                                '<option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="">Selecciona Municipio</option>';
                                            if (data.length > 0) {
                                                for (let i = 0; i < data.length; i++) {
                                                    html +=
                                                        `<option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="${data[i].id }">${data[i].municipio}</option>`;
                                                }
                                            }
                                            document.querySelector('#municipio').innerHTML = html;
                                        })
                                        .catch(error => {
                                            console.error(error);
                                        });
                                }
                            </script>
                        </div>

                        {{-- images --}}
                        @php
                            $image1 = $data->imageables[1]->url;
                            if (empty($image1) || is_null($image1)) {
                                $image1 = 'noPhoto.jpg';
                            }

                            $imagePath1 = getImagePath('/coordinators/');

                            $image1Exists = urlExists($imagePath1 . $image1);
                            
                            // $pathImages = 'http://front.test/images/';
                            // dd($imagePath1 . $image1);
                            // dd($image1Exists);
                        @endphp

                        <div class="h-fit bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4">
                            <div class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4">
                                <h4
                                    class="text-xl text-gray-900 dark:text-white font-bold border-b py-2 dark:border-gray-500">
                                    Imágen 1</h4>
                                <ul class="mt-2 text-gray-700">
                                    @if ($image1Exists)
                                        <img id="img1"
                                            class="w-full rounded-lg border border-gray-500 shadow-[0px_0px_10px_0px_#4A5568]"
                                            alt="..."
                                            src="{{ $imagePath1 . $image1 }}?{{ rand() }}" />
                                    @else
                                        <img id="img1"
                                            class="w-full rounded-lg border border-gray-500 shadow-[0px_0px_10px_0px_#4A5568]"
                                            alt="..."
                                            src="{{ asset('images/extras/noPhoto.jpg') }}?{{ rand() }}" />
                                    @endif
                                    <li class="flex flex-column justify-center">
                                        <button data-name="img1" onclick="importData('img1')" type="button"
                                            class="max-w-[100px] py-1 px-3 bg-teal-600 hover:bg-teal-700 focus:ring-teal-500 focus:ring-offset-teal-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg mt-2">Elegir
                                            Imagen</button>
                                    </li>
                                    <input name="img1" type="file" class="hidden" accept=".jpeg,.jpg">
                                </ul>
                            </div>
                        </div>


                        {{-- Submit --}}
                        <div class="col-span-full flex justify-center mt-3">
                            <button type="submit"
                                class="max-w-[140px] py-2 px-4 flex justify-center items-center  bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                <svg width="20" height="20" fill="currentColor" class="mr-2"
                                    viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1344 1472q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm256 0q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm128-224v320q0 40-28 68t-68 28h-1472q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h427q21 56 70.5 92t110.5 36h256q61 0 110.5-36t70.5-92h427q40 0 68 28t28 68zm-325-648q-17 40-59 40h-256v448q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-448h-256q-42 0-59-40-17-39 14-69l448-448q18-19 45-19t45 19l448 448q31 30 14 69z">
                                    </path>
                                </svg>
                                Guardar
                            </button>
                        </div>
                    </form>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('form').submit(function(event) {
                                var name = $('input[name="name"]').val();
                                var first_lname = $('input[name="first_lname"]').val();
                                var dni = $('input[name="dni"]').val();
                                var phone = $('input[name="phone"]').val();
                                var municipio = $('select[name="municipio"]').val();

                                var emptyFields = [];
                                if (!name) emptyFields.push('Nombre');
                                if (!first_lname) emptyFields.push('Apellido 1');
                                if (!dni) emptyFields.push('DNI/NIE');
                                if (!phone) emptyFields.push('Teléfono');
                                if (!municipio) emptyFields.push('Municipio');

                                if (emptyFields.length > 0) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error en Formulario',
                                        allowOutsideClick: false,
                                        showConfirmButton: true
                                    });
                                    event.preventDefault();
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Grabando Datos...',
                                        text: '¡Atención!. No Cierre el navegador, ni cambie de página hasta que reciba el mensaje de confirmacion!',
                                        allowOutsideClick: false,
                                        showConfirmButton: false
                                    });
                                }
                            });
                        });

                        function importData(imageId) {
                            let img = document.getElementById(imageId);
                            let input = document.querySelector(`input[name=${imageId}]`);

                            input.onchange = function() {
                                let files = Array.from(input.files);
                                const fileSize = files[0].size;
                                const fileType = files[0].type;
                                // Verificar si el archivo es una imagen o un video
                                if (fileType.includes('image/jpeg')) {
                                    // Verificar si el tamaño del archivo es menor a 1MB
                                    if (fileSize <= 1048576 * 2) {
                                        // Cambiar la imagen solo si se cumplen todas las condiciones
                                        img.src = URL.createObjectURL(files[0]);
                                        let newImage = "temp_" + Date.now() + "_" + files[0].name;
                                        // Obtener el nombre del campo de archivo a través del atributo data-name del botón
                                        let button = document.querySelector(`button[data-name=${imageId}]`);
                                        let fieldName = button.getAttribute('data-name');
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error en Formulario',
                                            html: 'El tamaño máximo permitido es de 2Mb',
                                            allowOutsideClick: false,
                                            showConfirmButton: true,
                                        });
                                        event.preventDefault();
                                    };
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error en Formulario',
                                        html: 'La imágen tiene que ser un JPG/JPEG válido',
                                        allowOutsideClick: false,
                                        showConfirmButton: true,
                                    });
                                    event.preventDefault();
                                };
                            };
                            input.click();
                        }

                        function importFile(fileId) {
                            let file = document.getElementById(fileId);
                            let input = document.querySelector(`input[name=${fileId}]`);
                            let file1name = document.getElementById('file1Name');
                            // console.log(file1name);

                            input.onchange = function() {
                                let files = Array.from(input.files);
                                const fileSize = files[0].size;
                                const fileType = files[0].type;
                                const fileName = files[0].name;
                                // Verificar si el archivo es una imagen o un video
                                if (fileType.includes('pdf')) {
                                    // Verificar si el tamaño del archivo es menor a 2MB
                                    if (fileSize <= 1048576 * 2) {
                                        // Obtener el nombre del campo de archivo a través del atributo data-name del botón
                                        let button = document.querySelector(`button[data-name=${fileId}]`);
                                        let fieldName = button.getAttribute('data-name');
                                        if (fileName.length >= 20) {
                                            file1Name.textContent = fileName.substring(20, -1) + ' ... pdf';
                                        } else {
                                            file1Name.textContent = fileName;
                                        }
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error en Formulario',
                                            html: 'El tamaño máximo permitido es de 2Mb',
                                            allowOutsideClick: false,
                                            showConfirmButton: true,
                                        });
                                        event.preventDefault();
                                    };
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error en Formulario',
                                        html: 'No es un PDF válido',
                                        allowOutsideClick: false,
                                        showConfirmButton: true,
                                    });
                                    event.preventDefault();
                                };
                            };
                            input.click();
                        }
                    </script>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
