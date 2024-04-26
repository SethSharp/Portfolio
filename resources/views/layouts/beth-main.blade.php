<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> @yield('title', config('app.name')) </title>

    @stack('meta')

    @vite('resources/css/app.css')
    @vite('resources/js/main.js')

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('/beth/favicon.ico') }}" type="image/x-icon">

    @routes
    @livewireStyles
</head>

<body class="mg-0 pd-0 font-serif">

<header>
    <x-navigation.beth.navbar/>
</header>

<main>
    <section class="min-h-screen">
        <div class="w-4/5 mx-auto my-10">
            @yield("content")
        </div>
    </section>
</main>

<x-layouts.beth.footer/>

@livewireScriptConfig
</body>

