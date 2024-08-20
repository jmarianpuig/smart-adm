<div>
    @php
        $created_at = strtotime($info->created_at);
        $created_at_sp = date('d-m-Y', $created_at);

        // Calcular los dias desde el alta hasta hoy
        $diff = intval(abs(time() - $created_at) / (60 * 60 * 24));
    @endphp

    <div class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4">
        <h4 class="text-xl text-gray-900  dark:text-white font-bold border-b py-2 dark:border-gray-500">Datos Personales Menor</h4>
        <ul class="mt-2 text-gray-700">
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Nombre:</span>
                <span
                    class="text-gray-700 dark:text-white">{{ $info->full_name }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">N. Artístico:</span>
                <span
                    class="text-gray-700 dark:text-white">{{ $info->alias }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Fec. Nac.:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->formattedBirthdate }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Edad:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->age }} años</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">DNI/NIE:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->formattedDni }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Nº Seg.Soc.:</span>
                <span class="text-gray-700 dark:text-white">{{ ($info->ss) }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Tel. Menor:</span>
                <span class="text-gray-700 dark:text-white">(34) {{ $info->formattedPhone }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Email Menor:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->user->email }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Dirección:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->adress }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">C. Postal:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->zip_code }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Municipio:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->municipio->municipio }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Provincia:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->municipio->provincia->provincia }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white">Fec. Alta:</span>
                <span class="text-gray-700 dark:text-white">{{ $created_at_sp }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white">Estado:</span>
                @if ($info->removed == '0')
                    <span class="font-bold text-green-500 dark:text-green-500">En Activo</span>
                @else
                    <span class="font-bold text-red-800 dark:text-red-500">En Papelera</span>
                @endif
            </li>
        </ul>
    </div>
    <div class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4 mt-4">
        <h4 class="text-xl text-gray-900  dark:text-white font-bold border-b py-2 dark:border-gray-500">Datos Padre/Madre/Tutor</h4>
        <ul class="mt-2 text-gray-700">
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Nombre:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->user->parents->full_name ?? 'No hay datos' }} </span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">DNI/NIE:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->user->parents->formattedDni ?? 'No hay datos'}} </span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Tel.:</span>
                <span class="text-gray-700 dark:text-white">(34) {{ $info->user->parents->formattedPhone ?? 'No hay datos'}} </span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Email:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->user->parents->email ?? 'No hay datos'}} </span>
            </li>
        </ul>
    </div>
    <div class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4 mt-4">
        <h4 class="text-xl text-gray-900  dark:text-white font-bold border-b py-2 dark:border-gray-500">Tallas y Medidas</h4>
        <ul class="mt-2 text-gray-700">
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Altura:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->height }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Camisa:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->shirt_size->size }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Pantalón:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->pant_size->size }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Zapatos:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->shoe_size->size }}</span>
            </li>
        </ul>
    </div>
    <div class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4 mt-4">
        <h4 class="text-xl text-gray-900  dark:text-white font-bold border-b py-2 dark:border-gray-500">Otros datos</h4>
        <ul class="mt-2 text-gray-700">
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Estudios:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->study->study }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Ojos:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->eye_color->color }}</span>
            </li>
            <li class="flex py-2">
            <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Pelos:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->hair_color->color }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Raza:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->race->race }}</span>
            </li>
            <li class="flex py-2">
                <span
                class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Disponibilidad:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->availability->availability }}</span>
            </li>
            {{-- <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Coche:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->formattedHasCar }}</span>
            </li> --}}
            <li class="flex py-2">
                <span
                class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Discapacidad:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->formattedIsDisabled }}</span>
            </li>
            {{-- <li class="flex py-2">
                <span
                class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Tatuajes:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->formattedHasTattoos }}</span>
            </li> --}}
            @if ($info instanceOf(App\Models\Xtra::class))
                <li class="flex py-2">
                    <span
                        class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Habilidades:</span>
                    <span class="text-gray-700 dark:text-white">{{ $info->skills }}</span>
                </li>
            @else
                <li class="flex py-2">
                    <span
                        class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Figuración:</span>
                    <span class="text-gray-700 dark:text-white">{{ $info->formattedIsExtra }}</span>
                </li>
            @endif
            <li class="flex py-2">
                <span
                    class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Url Book:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->url_book }}</span>
            </li>
        </ul>
    </div>
</div>