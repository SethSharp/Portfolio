@php use App\Http\EnvironmentEnum; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Portfolio') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    @if (config('environment.current') === EnvironmentEnum::SETH->value)
        <link rel="icon" href="{{ asset('/seth/favicon.ico') }}" type="image/x-icon">
    @else
        <link rel="icon" href="{{ asset('/beth/favicon.ico') }}" type="image/x-icon">
    @endif

    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js')
    @inertiaHead
</head>
<body class="font-sans antialiased">
@inertia
</body>
</html>
