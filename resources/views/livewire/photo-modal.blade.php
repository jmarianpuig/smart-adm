<div>

@php
    $modelTypes = [
        'App\Models\Xtra' => 'extras',
        'App\Models\Actor' => 'actors',
        'App\Models\Coordinator' => 'coordinators',
    ];

    if (isset($data[1]) && array_key_exists($data[1]->imageable_type, $modelTypes)) {
        $urls = getImagePath('/' . $modelTypes[$data[1]->imageable_type] . '/');
    } else {
        \Log::error('El índice 1 del array $data no está definido o el tipo de modelo no es válido', ['data' => $data]);
        throw new \Exception('El índice 1 del array $data no está definido o el tipo de modelo no es válido');
    }

        // Si el modelo es 'Coordinator', establece $data[2] a null
    if (isset($data[1]) && $data[1]->imageable_type == 'App\Models\Coordinator') {
        $data[2] = null;
    }

    if (isset($data[2]) && isset($data[2]->url)) {
        $image2Exists = urlExists($urls . $data[2]->url);
        $image2Exists ? $data[2]->url : $data[2]->url = 'noPhoto.jpg';
    }

    $image1Exists = urlExists($urls . $data[1]->url);
    $image1Exists ? $data[1]->url : $data[1]->url = 'noPhoto.jpg';
   
@endphp

    <div class="flex space-x-1">
        <div x-data="{ showModal: false, imgSrc: '' }">
            <!-- Botón o elemento para abrir el modal -->
            <button class="rounded-full w-8 h-8 bg-sky-800 flex items-center justify-center"
                @click="showModal = true; imgSrc = '{{ $urls . $data[1]->url }}'">
                <i class="text-white fas fa-lg fa-camera"></i>
            </button>
            <!-- Modal que se muestra al hacer clic en el botón -->
            <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center">
                <!-- Fondo oscuro detrás del modal -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 z-40" @click="showModal = false"></div>

                <!-- Contenido del modal -->
                <div class="fixed inset-0 z-50 flex items-center justify-center">
                    <div @click.outside="showModal = false">
                        <!-- Contenido del modal -->
                        <img style="max-height: 75vh; max-width: 100%; border-radius: 15px; width:100%; -webkit-box-shadow: inset -1px 3px 8px 5px #1F87FF, 2px 5px 16px 0px #0B325E, 5px 5px 15px 5px rgba(0,0,0,0); box-shadow: inset -1px 3px 8px 5px #1F87FF, 2px 5px 16px 0px #0B325E, 5px 5px 15px 5px rgba(0,0,0,0);"
                            :src="imgSrc" data-src="{{ $urls . $data[1]->url }}?{{ rand() }}" />
                    </div>
                </div>
            </div>
        </div>
        {{-- Componente para la segunda imagen si está disponible --}}
        @if (isset($data[2]->url))
            <div x-data="{ showModal: false, imgSrc: '' }">
                <!-- Botón o elemento para abrir el modal -->
                <button class="rounded-full w-8 h-8 bg-sky-800 flex items-center justify-center"
                    @click="showModal = true; imgSrc = '{{ $urls . $data[2]->url }}'">
                    <i class="text-white fas fa-lg fa-camera"></i>
                </button>
                <!-- Modal que se muestra al hacer clic en el botón -->
                <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center">
                    <!-- Fondo oscuro detrás del modal -->
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 z-40" @click="showModal = false"></div>

                    <!-- Contenido del modal -->
                    <div class="fixed inset-0 z-50 flex items-center justify-center">
                        <div @click.outside="showModal = false">
                            <!-- Contenido del modal -->
                            <img style="max-height: 75vh; max-width: 100%; border-radius: 15px; width:100%; -webkit-box-shadow: inset -1px 3px 8px 5px #1F87FF, 2px 5px 16px 0px #0B325E, 5px 5px 15px 5px rgba(0,0,0,0); box-shadow: inset -1px 3px 8px 5px #1F87FF, 2px 5px 16px 0px #0B325E, 5px 5px 15px 5px rgba(0,0,0,0);"
                                :src="imgSrc" data-src="{{ $urls . $data[2]->url }}?{{ rand() }}" />
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
