<div class="my-4">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>
    <style>
        input, select{
            border: none;
            border-bottom: 0.5px solid teal !important;
            padding-left: 5px !important;
        }
    
        input:focus, select:focus {
            border:none;
            border-bottom: 0.5px solid rgb(216, 72, 15) !important;
    
        }
    </style>

    @php
        $route = match(get_class($data)) {
            App\Models\Actor::class => 'youngers.actors.update',
            App\Models\Xtra::class => 'youngers.extras.update',
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
                <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-2 dark:border-gray-500">Datos Personales Menor</h4>
                <ul class="mt-2 text-gray-700">

                    {{-- Name --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Nombre:</span>
                        <input type="text" name="name"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            value="{{ $data->name }}"  minlength="3" maxlength="30" required/>
                    </li>

                    {{-- first_lname --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Apellido 1:</span>
                            <input type="text" name="first_lname"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            value="{{ $data->first_lname }}"  minlength="3" maxlength="30" required/>
                    </li>

                    {{-- second_lname --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Apellido 2:</span>
                            <input type="text" name="second_lname"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            value="{{ $data->second_lname }}"  minlength="3" maxlength="30" />
                    </li>

                    {{-- Name --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">N. Artístico:</span>
                        <input type="text" name="alias"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            value="{{ $data->alias }}"  minlength="5" maxlength="80" />
                    </li>
    
                    {{-- Birthdate --}}
                    <li class="flex py-2">
                        <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Fec. Nac.:</span>
                        <input class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" type="text" name="birthdate" id="birthdate" value="{{ $data->birthdate }}" data-input placeholder="Fecha de nacimiento" required />
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
                        <input type="text"
                            name="dni"
                            id="dni"
                            value="{{ $data->dni }}"
                            placeholder="Falta DNI/NIF"
                            minlength="9"
                            maxlength="9"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" onblur="validateDNI(this.value)" required/>
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
                        <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Nº Seg.Soc.</span>
                        <input type="text" name="ss" class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" placeholder="Falta Nº Seg.Soc." value="{{ $data->ss }}" minlength="12" maxlength="12" />
                    </li>

                    {{-- Phone --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Tel. Menor:</span>
                        <div class="pointer-events-none inset-y-0 left-0 flex items-center pr-2">
                            <span class="text-gray-700 dark:text-gray-300">(34)</span>
                        </div>
                        <input type="text"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            minlength="9" maxlength="9" name="phone"
                            onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
                            value="{{ $data->phone }}" required/>
                    </li>
                    @error('phone')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- Email --}}
                    <li class="flex py-2">
                        <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Email Menor:</span>
                        <span class="text-gray-700 dark:text-gray-300">{{ $data->user->email }}</span>
                    </li>

                    {{-- Adress --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Dirección:</span>
                        <input type="text" name="adress"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            value="{{ $data->adress }}"  minlength="5" maxlength="80" />
                    </li>
                    @error('adress')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  

                    {{-- Zip Code --}}
                    <li class="flex py-2">
                        <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">C. Postal:</span>
                        <input type="text" name="zip_code"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            value="{{ $data->zip_code }}"
                            onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
                            minlength="5" maxlength="5"
                            />
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
                            <option class="text-gray-700 dark:text-white dark:bg-gray-700 focus:ring-transparent" value="{{ $data->municipio->provincia->id }}"
                                selected="selected">{{ $data->municipio->provincia->provincia }}</option>
                            @foreach ($provincias as $provincia)
                                <option class="text-gray-700 dark:text-white dark:bg-gray-700 focus:ring-transparent" value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
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
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->municipio->id }}"
                                selected="selected">{{ $data->municipio->municipio }}</option>
                        </select>
                    </li>
                    @error('municipio')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror      
                </ul>
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
    
                                let html = '<option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="">Selecciona Municipio</option>';
                                if (data.length > 0) {
                                    for (let i = 0; i < data.length; i++) {
                                        html += `<option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="${data[i].id }">${data[i].municipio}</option>`;
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
            <div class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4 mt-4">
                <h4 class="text-xl text-gray-900  dark:text-white font-bold border-b py-2 dark:border-gray-500">Datos del Padre/Madre/Tutor</h4>
                <ul class="mt-2 text-gray-700">
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Nombre:</span>
                        <input type="text" name="parents_name"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            value="{{ $data->user->parents->name ?? ''}}"  minlength="5" maxlength="30" />
                    </li>

                    {{-- first_lname --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Apellido 1:</span>
                            <input type="text" name="parents_first_lname"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            value="{{ $data->user->parents->first_lname ?? '' }}"  minlength="5" maxlength="30" />
                    </li>

                    {{-- second_lname --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Apellido 2:</span>
                            <input type="text" name="parents_second_lname"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            value="{{ $data->user->parents->second_lname ?? ''}}"  minlength="5" maxlength="30" />
                    </li>
                    
                    {{-- DNI/CIF --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">DNI/NIE:</span>
                        <input type="text"
                            name="parents_dni"
                            id="parents_dni"
                            value="{{ $data->user->parents->dni ?? ''}}"
                            placeholder="Falta DNI/NIF"
                            minlength="9"
                            maxlength="9"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" onblur="validateParentsDNI(this.value)" />
                    </li>
                    @error('parents_dni')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <script>
                        function validateParentsDNI(dni) {
                            var x = document.getElementById("parents_dni").value;
                            document.getElementById("parents_dni").value = x.toUpperCase();
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
                                        html: '</br><b style="color: red">DNI/NIE padre/madre/tutor incorrecto</b>',
                                        allowOutsideClick: false,
                                        showConfirmButton: true,
                                    });
                                    // Limpiar el campo del DNI
                                    document.getElementById("parents_dni").value = "";
                                    return false;
                                } else {
                                    return true;
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error en DNI/NIE',
                                    html: '</br><b style="color: red">DNI/NIE padre/madre/tutor no es válido</b>',
                                    allowOutsideClick: false,
                                    showConfirmButton: true,
                                });
                                document.getElementById("parents_dni").value = "";
                                return false;
                            }
                        }
                    </script>

                    {{-- Phone --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Tel.:</span>
                        <div class="pointer-events-none inset-y-0 left-0 flex items-center pr-2">
                            <span class="text-gray-700 dark:text-gray-300">(34)</span>
                        </div>
                        <input type="text"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            minlength="9" maxlength="9" name="parents_phone"
                            onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
                            value="{{ $data->user->parents->phone ?? ''}}" />
                    </li>
                    @error('parents_phone')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    {{-- email --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Email:</span>
                        <input type="email"
                            class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            minlength="9" maxlength="50" name="parents_email"
                            value="{{ $data->user->parents->email ?? ''}}" />
                    </li>
                    @error('parents_email')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    
                </ul>
            </div>

            <div class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4 mt-4">
                <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-2 dark:border-gray-500">Tallas y Medidas</h4>
                <ul class="mt-2 text-gray-700">
                    <li class="flex py-2">
                        <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Altura:</span>
                        <input type="number" min="50" max="220" name="height"
                        class="w-full h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                        placeholder="Altura (cm)" value="{{ $data->height }}" required />
                        @error('height')
                            <span class="text-sm text-red-700">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </li>
                    <li class="flex py-2">
                        <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Camisa:</span>
                        <select name="shirt_size"
                            class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                            @php
                                $sizes = \App\Models\ShirtSize::all();
                            @endphp
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->shirt_size_id }}"
                                selected="selected">{{ $data->shirt_size->size }}</option>
                            @foreach ($sizes as $size)
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $size->id }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                        @error('shirt_size')
                            <span class="text-sm text-red-700">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </li>
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Pantalón:</span>
                        <select name="pant_size"
                            class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                            @php
                                $sizes = \App\Models\PantSize::all();
                            @endphp
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->pant_size_id }}"
                                selected="selected">{{ $data->pant_size->size }}</option>
                            @foreach ($sizes as $size)
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $size->id }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                        @error('pant_size')
                            <span class="text-sm text-red-700">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </li>
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Zapatos:</span>
                        <select name="shoe_size" class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                            @php
                                $sizes = \App\Models\ShoeSize::all();
                            @endphp
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->shoe_size_id }}"
                                selected="selected">{{ $data->shoe_size->size }}</option>
                            @foreach ($sizes as $size)
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $size->id }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                        @error('shoe_size')
                            <span class="text-sm text-red-700">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror  
                    </li>
                </ul>
            </div>
            <div class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4 mt-4">
                <h4 class="text-xl text-gray-900  dark:text-white font-bold border-b py-2 dark:border-gray-500">Otros datos</h4>
                <ul class="mt-2 text-gray-700">

                    {{-- Study --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Estudios:</span>
                        <select name="study" class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                            @php
                                $studies = \App\Models\Study::all();
                            @endphp
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->study_id }}"
                                selected="selected">{{ $data->study->study }}</option>
                            @foreach ($studies as $study)
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $study->id }}">{{ $study->study }}</option>
                            @endforeach
                        </select>
                    </li>
                    @error('study')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 

                    {{-- Eye color --}}
                    <li class="flex py-2">
                        <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Ojos:</span>
                        <select name="eye_color" class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                            @php
                                $colors = \App\Models\EyeColor::all();
                            @endphp
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->eye_color_id }}"
                                selected="selected">{{ $data->eye_color->color }}</option>
                            @foreach ($colors as $color)
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $color->id }}">{{ $color->color }}</option>
                            @endforeach
                        </select>
                    </li>
                    @error('eye_color')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- Hair Color --}}
                    <li class="flex py-2">
                        <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Pelos:</span>
                        <select name="hair_color" class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                            @php
                                $colors = \App\Models\HairColor::all();
                            @endphp
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->hair_color_id }}"
                                selected="selected">{{ $data->hair_color->color }}</option>
                            @foreach ($colors as $color)
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $color->id }}">{{ $color->color }}</option>
                            @endforeach
                        </select>
                    </li>
                    @error('hair_color')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- Race --}}
                    <li class="flex py-2">
                        <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Raza:</span>
                        <select name="race" class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                            @php
                                $races = \App\Models\Race::all();
                            @endphp
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->race_id }}"
                                selected="selected">{{ $data->race->race }}</option>
                            @foreach ($races as $race)
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $race->id }}">{{ $race->race }}</option>
                            @endforeach
                        </select>
                    </li>
                    @error('race')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 

                    {{-- Availability --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Disponibilidad:</span>
                        <select name="availability"
                        class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                            @php
                                $availabilites = \App\Models\Availability::all();
                            @endphp
                            <option  class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->availability_id }}"
                                selected="selected">{{ $data->availability->availability }}</option>
                            @foreach ($availabilites as $availability)
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $availability->id }}">{{ $availability->availability }}</option>
                            @endforeach
                        </select>
                    </li>
                    @error('availability')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- Is Disabled --}}
                    <li class="flex py-2">
                        <span
                            class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Discapacidad:</span>
                        <select name="is_disabled" class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->is_disabled }}"
                                selected="selected">{{ $data->formattedIsDisabled }}</option>
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="0">No</option>
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="1">Sí</option>
                        </select>
                    </li>
                    @error('is_disabled')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- Skils Extras --}}
                    @if ($data instanceOf(App\Models\Xtra::class))
                        <li class="flex py-2">
                            <span
                                class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Habilidades:</span>
                            <input name="skills" class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" type="text"
                                value="{{ $data->skills }}" />
                        </li>
                        @error('skills')
                            <span class="text-sm text-red-700">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    @endif

                    {{-- Is Actor --}}
                    @if ($data instanceOf(App\Models\Actor::class))
                        <li class="flex py-2">
                            <span
                                class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Figuración:</span>
                            <select name="is_extra" class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent">
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="{{ $data->is_extra }}" selected="selected">{{ $data->formattedIsExtra }}</option>
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="0">No</option>
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent" value="1">Sí</option>
                            </select>
                        </li>
                        @error('is_extra')
                            <span class="text-sm text-red-700">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    @endif

                    {{-- Url Book --}}
                    <li class="flex py-2">
                        <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Url
                            Book:</span>
                        <input type="text" name="url_book"
                            class="w-full py-0 h-6 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:ring-transparent"
                            value="{{ $data->urlBook }}" />
                    </li>
                    @error('url_book')
                        <span class="text-sm text-red-700">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </ul>
            </div>

            {{-- images --}}
            @php
                $image1 = $data->imageables[1]->url;
                if (empty($image1) || is_null($image1)) {
                    $image1 = 'noPhoto.jpg';
                }

                $image2 = $data->imageables[2]->url;
                if (empty($image2) || is_null($image2)) {
                    $image2 = 'noPhoto.jpg';
                }

                $imagePath1 = getImagePath('/extras/');
                $imagePath2 = getImagePath('/actors/');

                $image1Exists = urlExists($imagePath1 . $image1);
                $image2Exists = urlExists($imagePath1 . $image2); 
                $image3Exists = urlExists($imagePath2 . $image1);
                $image4Exists = urlExists($imagePath2 . $image2);
            @endphp
        </div>
        @if ($data instanceof App\Models\Xtra)
        <div class="h-fit bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4">
            <div  class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4">
                <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-2 dark:border-gray-500">Imágen 1</h4>
                <ul class="mt-2 text-gray-700">
                    @php ($image1Exists ? $image1 : $image1 = 'noPhoto.jpg') @endphp
                        <img id="img1" class="w-full rounded-lg border border-gray-500 shadow-[0px_0px_10px_0px_#4A5568]" alt="..." src="{{ $imagePath1 . $image1 }}?{{ rand() }}" />

                    <li class="flex flex-column justify-center">
                        <button data-name="img1" onclick="importData('img1')" type="button" class="max-w-[100px] py-1 px-3 bg-teal-600 hover:bg-teal-700 focus:ring-teal-500 focus:ring-offset-teal-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg mt-2">Elegir Imagen</button>
                    </li>
                    <input name="img1" type="file"  class="hidden"  accept=".jpeg,.jpg">
                </ul>
            </div>
            <div  class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4 mt-4">
                <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-2 dark:border-gray-500">Imágen 2</h4>
                <ul class="mt-2 text-gray-700">
                    @php ($image2Exists ? $image2 : $image2 = 'noPhoto.jpg') @endphp
                    <li>
                        <img id="img2" class="w-full rounded-lg border border-gray-500 shadow-[0px_0px_10px_0px_#4A5568]" alt="..." src="{{ $imagePath1 . $image2 }}?{{ rand() }}" />
                    </li>
                    <li class="flex flex-column justify-center">
                        <button data-name="img2"  onclick="importData('img2')" type="button" class="max-w-[100px] py-1 px-3 bg-teal-600 hover:bg-teal-700 focus:ring-teal-500 focus:ring-offset-teal-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg mt-2">Elegir Imagen</button>
                    </li>
                    <input name="img2" type="file" class="hidden"  accept=".jpeg,.jpg">
                </ul>
            </div>
        </div>
        @endif
        @if ($data instanceof App\Models\Actor)
        <div class="h-fit bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4">
            <div  class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4">
                <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-2 dark:border-gray-500">Imágen 1</h4>
                <ul class="mt-2 text-gray-700">
                    @php ($image4Exists ? $image1 : $image1 = 'noPhoto.jpg') @endphp
                    <li>
                        <img id="img1" class="w-full rounded-lg border border-gray-500 shadow-[0px_0px_10px_0px_#4A5568]" alt="..." src="{{ $imagePath2 . $image1 }}?{{ rand() }}" />
                    </li>
                    <li class="flex flex-column justify-center">
                        <button data-name="img1" onclick="importData('img1')" type="button" class="max-w-[100px] py-1 px-3 bg-teal-600 hover:bg-teal-700 focus:ring-teal-500 focus:ring-offset-teal-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg mt-2">Elegir Imagen</button>
                    </li>
                    <input name="img1" type="file"  class="hidden"  accept=".jpeg,.jpg">
                </ul>
            </div>
            <div  class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4 mt-4">
                <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-2 dark:border-gray-500">Imágen 2</h4>
                <ul class="mt-2 text-gray-700">
                    @php ($image4Exists ? $image1 : $image1 = 'noPhoto.jpg') @endphp
                    <li>
                        <img id="img2" class="w-full rounded-lg border border-gray-500 shadow-[0px_0px_10px_0px_#4A5568]" alt="..." src="{{ $imagePath2 . $image2 }}?{{ rand() }}" />
                    </li>
                    <li class="flex flex-column justify-center">
                        <button data-name="img2"  onclick="importData('img2')" type="button" class="max-w-[100px] py-1 px-3 bg-teal-600 hover:bg-teal-700 focus:ring-teal-500 focus:ring-offset-teal-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg mt-2">Elegir Imagen</button>
                    </li>
                    <input name="img2" type="file" class="hidden"  accept=".jpeg,.jpg">
                </ul>
            </div>
        </div>
        @endif

        {{--  Submit --}}
        <div class="col-span-full flex justify-center mt-3">
            <button type="submit" class="max-w-[140px] py-2 px-4 flex justify-center items-center  bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                <svg width="20" height="20" fill="currentColor" class="mr-2" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1344 1472q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm256 0q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm128-224v320q0 40-28 68t-68 28h-1472q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h427q21 56 70.5 92t110.5 36h256q61 0 110.5-36t70.5-92h427q40 0 68 28t28 68zm-325-648q-17 40-59 40h-256v448q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-448h-256q-42 0-59-40-17-39 14-69l448-448q18-19 45-19t45 19l448 448q31 30 14 69z">
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
                var height = $('input[name="height"]').val();
                var municipio = $('select[name="municipio"]').val();
                var parents_name = $('input[name="parents_name"]').val();
                var parents_first_lname = $('input[name="parents_first_lname"]').val();
                var parents_phone = $('input[name="parents_phone"]').val();
                var parents_dni = $('input[name="parents_dni"]').val();
                var parents_email = $('input[name="parents_email"]').val();

                var emptyFields = [];
                if (!name) emptyFields.push('Nombre del menor');
                if (!first_lname) emptyFields.push('Apellido 1 del menor');
                if (!dni && !dni2) emptyFields.push('DNI/NIE del menor');
                if (!height) emptyFields.push('Altura del menor');
                if (!municipio) emptyFields.push('Municipio del menor');
                if (!parents_name) emptyFields.push('Nombre de padre/madre/tutor');
                if (!parents_first_lname) emptyFields.push('Apellido 1 de padre/madre/tutor');
                if (!parents_phone) emptyFields.push('Teléfomp de padre/madre/tutor');
                if (!parents_dni) emptyFields.push('DNI/NIE de padre/madre/tutor');
                if (!parents_email) emptyFields.push('Email de padre/madre/tutor');

                if (emptyFields.length > 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en Formulario',
                        html: 'Los siguientes campos están vacíos:</br><b style="color: red">' + emptyFields.join(', ') + '</b>',
                        allowOutsideClick: false,
                        showConfirmButton: true,
                    });
                    event.preventDefault();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Grabando Datos...',
                        text: '¡Atención!. No Cierre el navegador, ni cambie de página hasta que reciba el mensaje de confirmacion!',
                        allowOutsideClick: false,
                        showConfirmButton: false,
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
                        console.log(fieldName);
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
    </script>
</div>
    