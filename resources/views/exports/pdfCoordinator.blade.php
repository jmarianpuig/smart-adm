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
            margin: auto;
            /* float: left; */
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

    <div class="text-center">
        <img id="logo" src="images/logos/logo.png" style="width: 100px; height: 100px;" alt="Logo" class="mx-auto mb-3">
        <h2 class="text-black">
            <strong>{{ $info->full_name }}</strong>
        </h2>
        <h4 id="nombreApellido">{{ $info->gender == 'Mujer' ? 'Coordinadora' : 'Coordinador' }}</h4>
    </div>
    <div class="max-image-container my-3">
        <img src="{{ $image . $info->imageables[1]->url }}"
            class="max-image">
    </div>
    {{-- @dd($info->fileables->url) --}}
    <div class="mt-4 details">
        <p><strong>Nombre:</strong> <span id="nombreCompleto">{{ $info->full_name }}</span></p>
        <p><strong>Localidad:</strong> <span id="localidadProvincia">{{ $info->municipio->municipio }}
                ({{ $info->municipio->provincia->provincia }})</span></p>
        <p><strong>Edad:</strong> <span id="edad">{{ $info->age }}</span></p>
        <p><strong>Tel.:</strong> <span id="phone">{{ $info->formattedPhone }}</span></p>
        <p><strong>Email:</strong> <span id="email">{{ $info->user->email }}</span></p>
        <p><strong>DNI/NIE:</strong> <span id="dni">{{ $info->formattedDni }}</span></p>
        <p><strong>Seg.Soc:</strong> <span id="ss">{{ $info->ss }}</span></p>

        <p><strong>Experiencia:</strong> <span id="experiencia">{{ $info->experience == '1' ? 'Sí' : 'No' }}</span></p>
        <p><strong>Disponibilidad:</strong> <span id="distancia">{{ $info->move_to_work->distance }}</span></p>
        <p><strong>Coche:</strong> <span id="coche">{{ $info->formattedHasCar }}</span></p>
        <p><strong>Curriculum:</strong> <span><a href="{{ $file . $info->fileables->url }}" target="_blank" style="text-decoration: none; {{ $info->fileables->url ? 'color:green' : 'color:red' }}" >{{ $info->fileables->url ?? 'No dispone'}}</a></span></p>
    </div>
    @livewireScripts
</body>
