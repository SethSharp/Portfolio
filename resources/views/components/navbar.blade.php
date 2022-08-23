@props(['home' => 'border-transparent'])
@props(['about' => 'border-transparent'])
@props(['qualifications' => 'border-transparent'])
@props(['projects' => 'border-transparent'])

<div class="z-30 h-20 mb-4 w-full fixed float-right">
    <div class="h-4"></div>
    <div class="justify-items-center
                -z-10 grid
                grid-rows-2 grid-cols-2
                sm:grid-rows-1 sm:grid-flow-col
                sm:float-right
                hidden
                sm:flex">
        <h1 class="text-xl font-bold text-center border-2 {{$home}} p-2.5
                   rounded-3xl hover:bg-black hover:text-white hover:animate-fade">
            <a href="/home"> Home </a>
        </h1>
        <h1 class="ml-0.5 text-xl font-bold text-center {{$about}} border-2 p-2.5
                   rounded-3xl hover:bg-black hover:text-white hover:animate-fade">
            <a href="/about"> About </a>
        <h1/>
        <h1 class="ml-0.5 text-xl font-bold text-center {{$qualifications}} border-2 p-2.5
                   rounded-3xl hover:bg-black hover:text-white hover:animate-fade">
            <a href="/qualifications"> Qualifications </a>
        <h1/>
        <h1 class="ml-0.5 text-xl font-bold text-center {{$projects}} border-2 p-2.5
                   rounded-3xl hover:bg-black hover:text-white hover:animate-fade">
            <a href="/projects"> Projects </a>
        </h1>
    </div>
    <div class="sm:hidden">
        <div class="mx-8">
            <div class="px-4 py-2 rounded float-right" id="menu-btn">
                <div class="h-2 my-2 w-12 ml-3 bg-black rounded-lg"></div>
                <div class="h-2 my-2 w-16 bg-black rounded-lg"></div>
                <div class="h-2 my-2 w-12 ml-3 bg-black rounded-lg"></div>
            </div>

            <div class="bg-white relative border border-black w-full hidden
                        flex-col rounded px-6 py-3 font-medium mt-24
                        text-center" id="dropdown">
                <a href="/home" class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{$home}}"> Home </a>
                <a href="/about" class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{$about}}"> About </a>
                <a href="/qualifications" class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{$qualifications}}"> Qualifications </a>
                <a href="/projects" class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{$projects}}"> Projects </a>
            </div>
        </div>

        <script>
            window.addEventListener('DOMContentLoaded', ()=> {
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
