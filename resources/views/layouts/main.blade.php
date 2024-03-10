<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> @yield('title', config('app.name')) </title>
    <meta name="description"
          content="Hey I am Seth Sharp, a Junior Software developer at Coding Labs on the Gold Coast. I love to build ambitious projects and love the art of programming.">

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    @routes
    @livewireStyles
</head>

<body class="mg-0 pd-0">
@livewireScripts
<main>
    <x-nav-bar/>

    <div class="ml-8 sm:ml-16">
        <h1 class="text-3xl font-bold text-black inline-block pr-2">
            @yield('partOne')
        </h1>
        <h1 class="text-3xl font-bold text-amber-400 inline-block">
            @yield('partTwo')
        </h1>
    </div>

    <div class="md:flex w-3/4 mx-auto mt-2 sm:mt-8 mb-12">
        @yield("content")
    </div>

    <livewire:footer/>
</main>
</body>

