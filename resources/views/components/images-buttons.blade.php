@if ($data->imageables[1]->imageable_type === 'App\Models\Xtra')
    @php

        $img1 = $data->imageables[1]->url;
        $img2 = $data->imageables[2]->url;
        $url1 = 'https://smartfiguracion.es/public/images/extras/' . $img1;
        $url2 = 'https://smartfiguracion.es/public/images/extras/' . $img2;

        $defaultImageUrl = 'https://smartfiguracion.es/public/images/extras/noPhoto.jpg';

        $contentsImg = @file_get_contents($url1);

        if ($contentsImg === false) {
            $url1 = $defaultImageUrl;
        }

        $contentsImg = @file_get_contents($url2);

        if ($contentsImg === false) {
            $url2 = $defaultImageUrl;
        }

    @endphp
@elseif ($data->imageables[1]->url === 'App\Models\Actor')
    @php
        $img1 = $data->imageables[1]->url;
        $img2 = $data->imageables[2]->url;
        $url1 = 'https://smartfiguracion.es/public/images/actors/' . $img1;
        $url2 = 'https://smartfiguracion.es/public/images/actors/' . $img2;
    @endphp
@endif

@php

@endphp

<div class="flex space-x-1">
    <div x-data="{ showModal: false, imgSrc: '' }">
        <!-- Botón o elemento para abrir el modal -->
        <button class="rounded-full w-8 h-8 bg-sky-800 flex items-center justify-center"
            @click="showModal = true; imgSrc = '{{ $url1 }}'">
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
                        :src="imgSrc" data-src="{{ $url1 }}" />
                </div>
            </div>
        </div>
    </div>

    <div x-data="{ showModal: false, imgSrc: '' }">
        <!-- Botón o elemento para abrir el modal -->
        <button class="rounded-full w-8 h-8 bg-sky-800 flex items-center justify-center"
            @click="showModal = true; imgSrc = '{{ $url2 }}'">
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
                        :src="imgSrc" data-src="{{ $url2 }}" />
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para cargar las imágenes al hacer clic en el botón
    document.addEventListener('DOMContentLoaded', function() {
        const imgElements = document.querySelectorAll('[data-src]');
        imgElements.forEach(function(img) {
            img.addEventListener('click', function() {
                if (img.src !== img.getAttribute('data-src')) {
                    img.src = img.getAttribute('data-src');
                }
            });
        });
    });
</script>
