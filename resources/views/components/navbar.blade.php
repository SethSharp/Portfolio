@props(['home' => 'no-underline'])
@props(['about' => 'no-underline'])
@props(['qualifications' => 'no-underline'])
@props(['projects' => 'no-underline'])
@props(['wil' => 'no-underline'])

<div class="z-30 h-20 mb-4 w-full fixed float-right sm:pr-10">
    <div class="h-4"></div>
    <div class="justify-items-center
                -z-10 grid
                grid-rows-2 grid-cols-2
                sm:grid-rows-1 sm:grid-flow-col
                sm:float-right
                hidden
                sm:flex">
        <a class="my-auto mx-auto text-xl font-bold text-center {{ $home }} underline underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400"
           href="/home">
            Home
        </a>
        <a class="my-auto mx-auto text-xl font-bold text-center {{ $about }} underline underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400"
           href="/about">
            About
        </a>
        <a class="my-auto mx-auto text-xl font-bold text-center {{ $qualifications }} underline underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400"
           href="/capabilities">
            Capabilities
        </a>
        <a class="my-auto mx-auto text-xl font-bold text-center {{ $projects }} underline underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400"
           href="/projects">
            Projects
        </a>
    </div>
    <div class="sm:hidden">
        <div class="mx-8">
            <div class="px-4 py-2 rounded float-right" id="menu-btn">
                <div class="h-2 my-2 w-12 ml-3 bg-gray-400 opacity-50 rounded-lg"></div>
                <div class="h-2 my-2 w-16 bg-gray-400 opacity-50 rounded-lg"></div>
                <div class="h-2 my-2 w-12 ml-3 bg-gray-400 opacity-50 rounded-lg"></div>
            </div>

            <div class="bg-white relative shadow-2xl w-full hidden
                        flex-col rounded px-6 py-3 font-medium mt-24
                        text-center" id="dropdown">
                <a href="/home"
                   class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{$home}}">
                    Home
                </a>
                <a href="/about"
                   class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{$about}}">
                    About
                </a>
                <a href="/capabilities"
                   class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{$qualifications}}">
                    Capabilities
                </a>
                <a href="/projects"
                   class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{$projects}}">
                    Projects
                </a>
            </div>
        </div>

        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const menuBtn = document.querySelector('#menu-btn')
                const dropdown = document.querySelector('#dropdown')
                menuBtn.addEventListener('click', () => {
                    dropdown.classList.toggle('hidden')
                    dropdown.classList.toggle('flex')
                });
            });
        </script>
    </div>
</div>
