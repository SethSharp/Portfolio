<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> @yield('title', config('app.name')) </title>

    @vite('resources/css/app.css')
    @vite('resources/js/main.js')

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('/seth/favicon.ico') }}" type="image/x-icon">

    @stack('meta')
    @stack('links')
    @stack('styles')

    @routes
    @livewireStyles
</head>

<body class="bg-[#272626]">

<header>
    <x-navigation.seth.navbar/>
</header>

<x-patterns.circuit-board fill="#313030"/>

<main>
    <section class="min-h-screen relative mt-4">
        <div class="md:flex md:w-4/5 mx-4 md:mx-auto mt-2 sm:mt-8 mb-12">
            @yield("content")
        </div>
    </section>
</main>

<x-layouts.seth.footer/>

@livewireScriptConfig
</body>

