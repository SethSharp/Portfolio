
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Projects </title>
    @vite('resources/css/app.css')
</head>

<body class="mg-0 pd-0">
    <x-nav-bar projects="text-blue-800" ></x-nav-bar>

    <div class="mt-16 px-20 w-full">
        <h1 class="text-4xl font-bold text-black inline-block pr-2"> My </h1>
        <h1 class="text-4xl font-bold text-amber-400 inline-block"> Projects! </h1>
    </div>
    <div class="w-full">
        <x-project> </x-project>
    </div>
</body>
</html>
