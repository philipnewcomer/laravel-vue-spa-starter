<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script src="{{ mix('js/manifest.js') }}" defer></script>
        <script src="{{ mix('js/vendor.js') }}" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script>
          window.config = @json([
            'apiBaseUrl' => url('/api'),
            'appName' => config('app.name'),
          ])
        </script>

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="bg-grey-lightest h-screen antialiased">
        <div id="app">
            <app></app>
        </div>
    </body>
</html>
