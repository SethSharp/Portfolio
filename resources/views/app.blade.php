<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="mg-0 pd-0">

    <x-nav-bar home="text-blue-800"></x-nav-bar>

    <div class=" sm:h-1/5  w-full">
        <div class="pl-6 pr-6
                    md:pl-14 z-0
                    custom1:flex flex-row">

            {{-- Intro area --}}
            <div class="pl-2 pb-4 pt-16
                        md:pl-0 sm:pl-14
                        w-full
                        custom1:w-7/12
                        custom1:flex
                        custom1:flex-col">
                {{--Intor text--}}
                <div class="pl-2">
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
                    <button class="bg-blue-800 text-3xl text-white rounded-3xl w-48 mt-4
                               transition ease-in-out delay-0
                               p-1.5
                               hover:-translate-y-1 hover:scale-100 duration-50">
                            Hire me!
                    </button>
                </div>

                {{--Links--}}
                <div class="pt-14 pb-5">
                    <a class="pr-4" href="https://github.com/SethSharp">
                        <img class="w-16 h-16 inline-block
                                    transition ease-in-out delay-0
                                    hover:-translate-y-1 hover:scale-75 duration-50
                                    " src="/images/github_bgremoval.ai.png" alt="git-hub-link">
                    </a>
                    <a href="https://www.linkedin.com/in/seth-sharp-213bb3211/">
                        <img class="w-11 h-11 inline-block
                                    transition ease-in-out delay-0
                                    hover:-translate-y-1 hover:scale-75 duration-50"
                                    src="/images/linkedInNew.png" alt="git-hub-link">
                    </a>
                </div>
            </div>

            {{-- Profile image --}}

            <div class="sm:w-full custom1:w-8/12 w-full custom1:grow z-0 relative overflow-hidden">
                <img class="mt-10 md:mt-2
                            relative
                            z-20
                            w-3/4 sm:w-full lg:w-5/6"
                     src="/images/profileTrans.png"
                     alt="profile-picture">

                {{--Upper rectangles--}}
                <div class="w-1/2 h-6 absolute -top-1/4 ml-10 animate-rectDownFast">
                    <div class="w-full h-full bg-amber-400 rounded-3xl -rotate-[50deg] opacity-30"></div>
                </div>
                <div class="w-1/4 h-6 absolute top-3/4 -ml-52 animate-rectUpSlow opacity-30">
                    <div class="w-full h-full bg-amber-400 rounded-3xl -rotate-[50deg] opacity-60"></div>
                </div>
                <div class="w-1/2 h-6 absolute top-3/4 -ml-72 animate-rectUpMed">
                    <div class="w-full h-full bg-amber-400 rounded-3xl -rotate-[50deg] opacity-60"></div>
                </div>

                {{--Lower rectangle--}}
                <div class="w-1/4 h-6 absolute top-3/4 ml-64 animate-rectUpSlow">
                    <div class="w-full h-full bg-blue-700 rounded-3xl -rotate-[50deg]"></div>
                </div>
                <div class="w-2/3 h-6 absolute top-full ml-16 animate-rectUpFast">
                    <div class="w-full h-full bg-blue-800 rounded-3xl -rotate-[50deg] opacity-30"></div>
                </div>
                <div class="w-1/2 h-6 absolute top-1/4 right-0 -mr-64 animate-rectDownSlow">
                    <div class="w-full h-full bg-blue-600 rounded-3xl -rotate-[50deg] opacity-75"></div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>


{{--<div class="w-56 overflow-hidden h-6 bg-blue-400  rounded-3xl absolute -rotate-[60deg] mt-[24rem] ml-2"> </div>

            <div class="w-1/5 h-6 bg-blue-600 opacity-10 rounded-3xl absolute -rotate-45 ml-36 mt-44"> </div>

            <div class="w-1/3 h-6 bg-blue-600 opacity-20 rounded-3xl absolute -rotate-45 mt-40 ml-40 mt-44"> </div>
        --}}
