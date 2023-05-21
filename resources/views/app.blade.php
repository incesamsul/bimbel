<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/css/app.css', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>


<body id="page-top">
    <div id="flash-message">
        <div class="flash-message shadow">
            <i class="fas fa-info-circle"></i>
            <span class="ml-3"></span>
        </div>
    </div>
    @inertia
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
</body>

</html>
