<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="mg-0 pd-0">
{{--  Allows nav bar to snap to this  --}}
<div class="h-4"></div>
{{--  Navbar  --}}
<div class="bg-gray-50 justify-items-center
            grid
            grid-rows-2 grid-cols-2
            sm:grid-rows-1 sm:grid-flow-col
            sm:float-right">
    <h1 class="text-2xl text-center text-gray-800 border-2 p-2.5 border-transparent hover:border-2 hover:rounded-3xl hover:border-black hover:animate-fade"> Home </h1>
    <h1 class="text-2xl text-center text-gray-800 border-2 p-2.5 border-transparent hover:border-2 hover:rounded-3xl hover:border-black hover:animate-fade"> About </h1>
    <h1 class="text-2xl text-center text-gray-800 border-2 p-2.5 border-transparent hover:border-2 hover:rounded-3xl hover:border-black hover:animate-fade"> Projects </h1>
    <h1 class="text-2xl text-center text-gray-800 border-2 p-2.5 border-transparent hover:border-2 hover:rounded-3xl hover:border-black hover:animate-fade"> Qualification </h1>
</div>

{{--    <div class="sm:flex flex-row bg-gray-500">--}}
{{--        <div class="bg-red-500 sm:w-1/2 w-full sm:grow sm:basis-0 sm:flex sm:flex-col">--}}
{{--            Intro--}}
{{--        </div>--}}
{{--        <div class=" bg-yellow-300 sm:w-1/2 w-full sm:grow sm:flex-col sm:basis-0">--}}
{{--            Profile--}}
{{--        </div>--}}
{{--    </div>--}}

{{--sm:bg-yellow-200 md:bg-red-200 lg:bg-green-200--}}
<div class="bg-gray-50 sm:h-4/4 mt-4 sm:mt-16 w-full">

    <div class="pl-6 pr-6
                md:pl-14
                custom1:flex flex-row">

        <div class="pl-2 pb-4 pt-16
                    md:pl-0 sm:pl-14
                    w-full
                    custom1:w-5/12
                    custom1:flex
                    custom1:flex-col">

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
        {{--sm:flex-col sm:basis-0--}}
        <div class="sm:w-full
                    custom1:w-7/12
                    w-full
                    custom1:grow">

                <img class="mt-10 md:mt-2
                            w-3/4 sm:w-full lg:w-5/6"
                            src="/images/pfp.png" alt="profile-picture">

        </div>
    </div>

</div>
</body>
</html>
