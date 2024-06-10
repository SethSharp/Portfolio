<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> @yield('title', config('app.name')) </title>

    @vite('resources/css/app.css')
    @vite('resources/js/main.js')

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('/beth/favicon.ico') }}" type="image/x-icon">

    @stack('meta')
    
    @routes
    @livewireStyles
</head>

<body class="font-serif">

<header>
    <x-navigation.beth.navbar/>
</header>

<main>
    <section class="min-h-screen">
        <div class="w-4/5 mx-auto my-8">
            @yield("content")
        </div>
    </section>
</main>

<x-layouts.beth.footer/>

@livewireScriptConfig
</body>

