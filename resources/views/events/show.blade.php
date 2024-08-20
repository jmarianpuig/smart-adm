<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="xs:w-full xl:w-7/12 mx-auto py-4 px-4 sm:px-6 lg:px-4">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Eventos TV
                </h2>
                @php
                    $event = $data->name;
                @endphp
                <a href="{{ route('events.index') }}"
                    class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-3 rounded inline-block text-center">Volver</a>
            </div>
        </div>
    </header>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">

            <div
                class="xs:w-full xl:w-7/12 mx-auto sm:px-6 lg:px-8 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-3 dark:border-gray-500">
                            Ver Evento TV - {{ $data->name }}
                        </h4>
                        <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                        <ul class="mt-4 text-gray-700 flex flex-wrap">
                            <li class="flex w-full sm:w-2/3 py-3 px-3">
                                <label for="name" class="w-full dark:text-white">Título Evento
                                    <input type="text" name="name" id="name" value="{{ $data->name }}"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        readonly>
                                </label>
                            </li>
                            <li class="flex w-full sm:w-1/3 py-3 px-3">
                                <label for="place" class="w-full dark:text-white">Localidad
                                    <input type="text" name="place" id="place"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        value="{{ $data->place }}" readonly>
                                </label>
                            </li>
                            <li class="flex w-full py-3 px-3">
                                <label for="description" class="w-full dark:text-white">Descripción
                                    <textarea name="description" id="description" rows="4"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        placeholder="Descripcion del Evento" readonly>{{ $data->description }}</textarea>
                                </label>
                            </li>
                            <li class="flex w-full sm:w-1/3 py-3 px-3">
                                <label for="event_date" class="w-full dark:text-white">Fecha del Evento
                                    <input type="text" name="event_date" id="event_date"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        value="{{ $data->formatted_event_date }}" readonly>
                                </label>
                            </li>
                            <li class="flex w-full sm:w-1/3 py-3 px-3">
                                <label for="status" class="w-full dark:text-white">Estado del Evento
                                    @php
                                        $status = '';
                                        if ($data->status == '0') {
                                            $status = 'En Preparación';
                                        } elseif ($data->status == '1') {
                                            $status = 'Finalizado';
                                        } elseif ($data->status == '2') {
                                            $status = 'Suspendido/Aplazado';
                                        } else {
                                            abort(404);
                                        }
                                    @endphp
                                    <input type="text" name="status" id="status"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        value="{{ $status }}" readonly>
                                </label>
                            </li>
                            <li class="flex w-full sm:w-1/3 py-3 px-3">
                                <label for="created_by" class="w-full dark:text-white">Evento Creado por:
                                    <input type="text" name="created_by" id="created_by"
                                        value="{{ $data->created_by }}"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                        placeholder="" readonly>
                                    <input type="text" name="user_id" id="user_id" value="{{ $data->user_id }}"
                                        class="hidden px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                        placeholder="" readonly>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div
                class="xs:w-full xl:w-7/12 mx-auto sm:px-6 lg:px-8 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4 mt-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-3 dark:border-gray-500 mb-4 w-full">
                                Añadir/Eliminar Participantes
                                <a href="{{ route('eventsViewers.excel', $data) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-2 px-3 rounded inline-block text-center mx-auto float-right"><i class="fa-solid fa-file-excel"></i> Seleccionados</a>
                            </h4>
                        </div>

                        <livewire:viewers-event-table :data='$data->id' />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
