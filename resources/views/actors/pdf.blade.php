<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Audiovisual') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    {{-- @wireUiScripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

<body>
    <style>
        .text-center {
            text-align: center;
        }

        .max-image-container {
            width: 350px;
            height: 450px;
            margin-right: 30px;
            float: left;
        }

        .max-image {
            max-width: 100%;
            max-height: 100%;
        }

        .details {
            clear: left;
        }

        .details p {
            margin-bottom: 2px;
            /* Ajusta el valor según tu preferencia */
        }
    </style>

    <div class="text-center">
        <img id="logo" src="images/logos/logo.png" style="width: 100px; height: 100px" alt="Logo" class="mx-auto mb-3">
        <h2 class="text-black">
            <strong>{{ ucwords($actor->name . ' ' . $actor->first_lname . ' ' . $actor->second_lname) }}</strong>
        </h2>
        <h4 id="nombreApellido"></h4>
    </div>
    <div class="max-image-container my-3">
        <img class="max-image" src="https://smartfiguracion.es/public/images/actors/{{ $actor->imageables[1]->url }}"
            alt="Imagen 1" class="max-image">
    </div>
    <div class="max-image-container my-3">
        <img src="https://smartfiguracion.es/public/images/actors/{{ $actor->imageables[2]->url }}" alt="Imagen 2"
            class="max-image" style="">
    </div>
    <div class="mt-4 details">
        <p><strong>Nombre:</strong> <span
                id="nombreCompleto">{{ ucwords($actor->name . ' ' . $actor->first_lname . ' ' . $actor->second_lname) }}</span>
        </p>
        <p><strong>Localidad:</strong> <span id="localidadProvincia">{{ $actor->municipio->municipio }}
                ({{ $actor->municipio->provincia->provincia }})</span></p>
        <p><strong>Edad:</strong> <span id="edad">{{ $actor->age }} años</span></p>
        <p><strong>Altura:</strong> <span id="altura">{{ $actor->height }} cm.</span></p>
        <p><strong>Talla Pantalon:</strong> <span id="tallaPantalon">{{ $actor->pant_size->size }}</span></p>
        <p><strong>Talla Camisa:</strong> <span id="tallaCamisa">{{ $actor->shirt_size->size }}</span></p>
        <p><strong>Talla Zapatos:</strong> <span id="tallaZapatos">{{ $actor->shoe_size->size }}</span></p>
    </div>
    @livewireScripts
</body>
