<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> @yield('title', config('app.name')) </title>

    @stack('meta')

    @vite('resources/css/app.css')
    @vite('resources/js/main.js')

    @stack('links')

    @stack('styles')

    <link rel="preconnect" href="https://fonts.bunny.net">

    @routes
    @livewireStyles
</head>

<body class="bg-[#272626]">

<header>
    <x-navigation.seth.navbar/>
</header>

<div class="animate-pulse duration-1000 -z-10 absolute w-full">
    <x-patterns.circuit-board fill="#292929"/>
</div>

<main>
    <section class="min-h-screen relative">
        <div class="md:flex w-4/5 mx-auto mt-2 sm:mt-8 mb-12">
            @yield("content")
        </div>
    </section>
</main>

<x-layouts.seth.footer/>

@livewireScriptConfig
</body>

