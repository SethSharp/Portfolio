<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="mg-0 pd-0">
{{--  Allows nav bar to snap to this  --}}

{{--  Navbar  --}}
<x-nav-bar></x-nav-bar>

{{--sm:bg-yellow-200 md:bg-red-200 lg:bg-green-200--}}
<div class="bg-gray-50 sm:h-1/5 mt-4 sm:mt-16 w-full">
    <div class="pl-6 pr-6
                md:pl-14
                z-10
                custom1:flex flex-row">

        <div class="pl-2 pb-4 pt-16
                    md:pl-0 sm:pl-14
                    w-full
                    custom1:w-5/12
                    custom1:flex
                    custom1:flex-col
                    z-20
                    bg-gray-50">

            <div class="">
                <h1 class="text-6xl font-bold"> Hi! </h1>
            </div>
            <div class="">
                <h1 class="text-6xl font-bold inline-block pr-2"> I'm </h1>
                <h1 class="text-6xl font-bold text-amber-400 inline-block text-opacity-19.5">  Seth Sharp </h1>
            </div>

            <div class="pt-14">
                <h1 class="text-gray-400 text-2xl"> Developer by day </h1>
                <h1 class="text-gray-400 text-2xl"> Pizza Thrower by night</h1>
            </div>
            <button class="bg-blue-800 text-3xl text-white rounded-3xl w-48 mt-4"> Hire me! </button>

            <div class="pt-14 pb-5">
                <a class="pr-4" href="https://github.com/SethSharp">
                    <img class="w-14 h-14 inline-block" src="/images/github.png" alt="git-hub-link">
                </a>
                <a href="https://www.linkedin.com/in/seth-sharp-213bb3211/">
                    <img class="w-14 h-14 inline-block" src="/images/linkedin.png" alt="git-hub-link">
                </a>
            </div>
        </div>

        {{-- Rectangle stuff --}}
{{--        <div class="bg-yellow-500 float-right mt-2">--}}
{{--            --}}{{--  Top row  --}}
{{--            <div class="w-1/4 h-6 bg-blue-300 rounded-3xl absolute -rotate-[60deg] mt-40 ml-10"> </div>--}}
{{--            <div class="w-56 overflow-hidden h-6 bg-blue-400  rounded-3xl absolute -rotate-[60deg] mt-[24rem] ml-2"> </div>--}}
{{--            --}}{{--  Second row  --}}
{{--            <div class="w-1/5 h-6 bg-blue-600 opacity-10 rounded-3xl absolute -rotate-45 ml-36 mt-44"> </div>--}}
{{--            --}}{{--  Third row  --}}
{{--            <div class="w-1/3 h-6 bg-blue-600 opacity-20 rounded-3xl absolute -rotate-45 mt-40 ml-40 mt-44"> </div>--}}
{{--        </div>--}}

        <div class="sm:w-full
                    custom1:w-7/12
                    w-full
                    z-20
                    custom1:grow">

                <img class="mt-10 md:mt-2
                            w-3/4 sm:w-full lg:w-5/6"
                            src="/images/pfp.png" alt="profile-picture">

        </div>
    </div>

</div>
</body>
</html>
