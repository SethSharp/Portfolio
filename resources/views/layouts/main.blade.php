<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> @yield('title', config('app.name')) </title>

    @stack('meta')

    @vite('resources/css/app.css')
    @vite('resources/js/main.js')

    <link rel="preconnect" href="https://fonts.bunny.net">

    @routes
    @livewireStyles
</head>

<body class="mg-0 pd-0">

<header>
    <x-nav-bar/>
</header>

<main>
    <section class="min-h-screen">
        <h1 class="ml-8 sm:ml-16 text-3xl font-bold ">
            <div class="text-black inline-block pr-2">
                @yield('partOne')
            </div>
            <div class="text-amber-400 inline-block">
                @yield('partTwo')
            </div>
        </h1>

        <div class="md:flex w-4/5 mx-auto mt-2 sm:mt-8 mb-12">
            @yield("content")
        </div>
    </section>
</main>

<livewire:footer/>

@livewireScriptConfig
</body>

