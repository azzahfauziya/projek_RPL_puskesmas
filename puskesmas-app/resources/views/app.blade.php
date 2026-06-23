<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,
        <svg viewBox='0 0 76 76' fill='none' xmlns='http://www.w3.org/2000/svg'>
            <path d='M41.4785 0C47.0013 3e-05 51.4785 4.4772 51.4785 10V14.3779C51.4785 19.9008 55.9557 24.3779 61.4785 24.3779H66C71.5229 24.3779 76 28.8551 76 34.3779V41.9814C76 47.5043 71.5229 51.9814 66 51.9814H61.4785C55.9557 51.9814 51.4785 56.4586 51.4785 61.9814V66.001C51.4783 71.5236 47.0012 76.001 41.4785 76.001H34.3916C28.8689 76.001 24.3918 71.5236 24.3916 66.001V61.9814C24.3916 56.4586 19.9144 51.9814 14.3916 51.9814H10C4.47715 51.9814 5.15422e-07 47.5043 0 41.9814V34.3779C0 28.8551 4.47715 24.3779 10 24.3779H14.3916C19.9144 24.3779 24.3916 19.9008 24.3916 14.3779V10C24.3916 4.4772 28.8688 0 34.3916 0H41.4785Z' fill='%23144B29'/>
        </svg>
        ">
        <title inertia>{{ config('app.name', 'Puskesmas Sehat') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
