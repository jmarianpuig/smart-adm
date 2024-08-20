<?php

if (!function_exists('getBaseUrl')) {
    function getBaseUrl()
    {
        return config('app.env') === 'production'
            ? config('filesystems.paths.base_url.production')
            : config('filesystems.paths.base_url.local');
    }
}

if (!function_exists('getImagePath')) {
    function getImagePath($path = '')
    {
        $basePath = config('app.env') === 'production'
            ? config('filesystems.paths.images.production')
            : config('filesystems.paths.images.local');

        return getBaseUrl() . $basePath . $path;
    }
}

if (!function_exists('getFilePath')) {
    function getFilePath($path = '')
    {
        $basePath = config('app.env') === 'production'
            ? config('filesystems.paths.files.production')
            : config('filesystems.paths.files.local');

        return getBaseUrl() . $basePath . $path;
    }
}

if (!function_exists('urlExists')) {
    function urlExists($url)
    {
        $headers = @get_headers($url);
        return $headers && strpos($headers[0], '200') != false;
    }
}

if (!function_exists('getServerPath')) {
    function getServerPath($path = '')
    {
        // Define el path base en producción según la configuración de tu servidor
        $serverBasePath = '/var/www/vhosts/39946890.servicio-online.net/smartfiguracion.es/public';

        return $serverBasePath . '/' . ltrim($path, '/');
    }
}

