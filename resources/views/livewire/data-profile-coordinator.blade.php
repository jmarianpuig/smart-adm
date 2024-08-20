<div>
    @php
        $created_at = strtotime($info->created_at);
        $created_at_sp = date('d-m-Y', $created_at);

        // Calcular los dias desde el alta hasta hoy
        $diff = intval(abs(time() - $created_at) / (60 * 60 * 24));
    @endphp

    <div class="flex-1 bg-white dark:bg-gray-700 dark:text-white rounded-lg shadow-xl p-4">
        <h4 class="text-xl text-gray-900  dark:text-white font-bold border-b py-2 dark:border-gray-500">Datos Personales
        </h4>
        <ul class="mt-2 text-gray-700">
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Nombre:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->full_name }}</span>
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
                <span class="text-gray-700 dark:text-white">{{ $info->ss }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Experiencia:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->formattedExperience }}</span>
            </li>
            <li class="flex py-2">
                <span
                    class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Disp.:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->move_to_work->distance }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Coche:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->formattedHasCar }}</span>
            </li>
            <li class="flex py-2">
                <span
                class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Docs.:</span>
                <span class="text-gray-700 dark:text-white"><a class="text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href="{{ asset( getFilePath() . '/coordinators/' . $info->fileables->url ) }}" target="_blank" styles="">Ver Curriculum</a></span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white">Alta:</span>
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
        <h4 class="text-xl text-gray-900  dark:text-white font-bold border-b py-2 dark:border-gray-500">Datos de
            Contacto</h4>
        <ul class="mt-2 text-gray-700">
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Teléfono:</span>
                <span class="text-gray-700 dark:text-white">(34) {{ $info->formattedPhone }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Email:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->user->email }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Dirección:</span>
                <span class="text-gray-700 dark:text-white">{{ $info->adress }}</span>
            </li>
            <li class="flex py-2">
                <span class="font-bold w-32 dark:text-white min-w-[125px] flex-grow-1 flex-shrink-1">Código
                    Postal:</span>
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
        </ul>
    </div>
</div>
