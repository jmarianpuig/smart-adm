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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

<body>
    <style>
        .text-center {
            text-align: center;
            margin-bottom: 30px;
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
        }
    </style>
    {{-- @dd($info->user->parents) --}}
    <div class="text-center">
        <img id="logo" src="images/logos/logo.png" style="width: 100px; height: 100px" alt="Logo"
            class="mx-auto mb-3">
        <h2 class="text-black">
            <strong>{{ $info->full_name }}</strong>
        </h2>
        <h4 id="nombreApellido">{{ $info instanceof \App\Models\Actor ? 'Actor/Actriz' : 'Figurante' }}</h4>
    </div>
    <div class="max-image-container my-3">
        <img src="{{ $url . $info->imageables[1]->url }}" class="max-image">
    </div>
    <div class="max-image-container my-3">
        <img src="{{ $url . $info->imageables[2]->url }}" class="max-image">
    </div>
    <div class="mt-4 details">
        <p><strong>Nombre:</strong> <span id="nombreCompleto">{{ $info->full_name }}</span></p>
        <p><strong>N. Artístico:</strong> <span id="nombreAlias">{{ $info->FormattedAlias }}</span></p>
        <p><strong>Localidad:</strong> <span id="localidadProvincia">{{ $info->municipio->municipio }}
                ({{ $info->municipio->provincia->provincia }})</span></p>
        <p><strong>Edad:</strong> <span id="edad">{{ $info->age }}</span></p>
        <p><strong>Altura:</strong> <span id="altura">{{ $info->height }}</span></p>
        <p><strong>Talla Pantalon:</strong> <span id="tallaPantalon">{{ $info->pant_size->size }}</span></p>
        <p><strong>Talla Camisa:</strong> <span id="tallaCamisa">{{ $info->shirt_size->size }}</span></p>
        <p><strong>Talla Zapatos:</strong> <span id="tallaZapatos">{{ $info->shoe_size->size }}</span></p>
        <p><strong>Url Videobook:</strong> <span><a href="{{ $info->url_book }}" target="_blank"
                    style="text-decoration: none; {{ $info->url_book ? 'color:green' : 'color:red' }}">{{ $info->url_book ?? 'No dispone' }}</a></span>
        </p>
    </div>
    @livewireScripts
</body>
