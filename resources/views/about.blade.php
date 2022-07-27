<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title> About </title>
</head>

<body class="mg-0 pd-0">

    <x-nav-bar about="text-blue-800" ></x-nav-bar>

    <div class="mt-16 px-20 w-full">
        <h1 class="text-4xl font-bold text-black inline-block pr-2"> About </h1>
        <h1 class="text-4xl font-bold text-amber-400 inline-block"> Me! </h1>
    </div>
    <div class="items-center flex flex-wrap sm:flex justify-center w-full mt-5 px-28">
        <x-about-card title="Who am I?"
                      content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum blandit massa vitae efficitur auctor. Integer ut dui hendrerit, finibus neque ac, venenatis purus. Mauris feugiat commodo lorem, non cursus felis sodales nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ">
        </x-about-card>

        <x-image-card caption="Me"></x-image-card>

        <x-about-card title="My hobbies?"
                      content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum blandit massa vitae efficitur auctor. Integer ut dui hendrerit, finibus neque ac, venenatis purus. Mauris feugiat commodo lorem, non cursus felis sodales nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ">
        </x-about-card>

        <x-image-card caption="Hobby image"></x-image-card>

        <x-about-card title="My Goals?"
                      content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum blandit massa vitae efficitur auctor. Integer ut dui hendrerit, finibus neque ac, venenatis purus. Mauris feugiat commodo lorem, non cursus felis sodales nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ">
        </x-about-card>

        <x-image-card caption="Some picture of something"></x-image-card>
    </div>



</body>
</html>
