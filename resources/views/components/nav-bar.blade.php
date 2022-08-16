@props(['home' => 'text-gray-800'])
@props(['about' => 'text-gray-800'])
@props(['qualifications' => 'text-gray-800'])
@props(['projects' => 'text-gray-800'])

<div class="z-10 h-20 mb-4 relative">
    <div class="h-4"></div>
    <div class="justify-items-center
                -z-10 grid
                grid-rows-2 grid-cols-2
                sm:grid-rows-1 sm:grid-flow-col
                sm:float-right
                hidden
                sm:flex
                ">
        <h1 class="text-xl font-bold text-center {{$home}} border-2 p-2.5 border-transparent
                   rounded-3xl hover:bg-black hover:text-white hover:animate-fade">
            <a href="/home"> Home </a>
        </h1>
        <h1 class="ml-0.5 text-xl font-bold text-center {{$about}} border-2 p-2.5 border-transparent
                   rounded-3xl hover:bg-black hover:text-white hover:animate-fade">
            <a href="/about"> About </a>
            <h1/>
        <h1 class="ml-0.5 text-xl font-bold text-center {{$qualifications}} border-2 p-2.5 border-transparent
                   rounded-3xl hover:bg-black hover:text-white hover:animate-fade">
            <a href="/qualifications"> Qualifications </a>
        <h1/>
        <h1 class="ml-0.5 text-xl font-bold text-center {{$projects}} border-2 p-2.5 border-transparent
                   rounded-3xl hover:bg-black hover:text-white hover:animate-fade">
            <a href="/projects"> Projects </a>
        </h1>
    </div>
    <div class="sm:hidden">
        <div class="mx-8 my-4">
            <div class="bg-gray-100 px-4 py-2 rounded" id="menu-btn">
                <div class="h-2 my-2 w-16 bg-gray-200"></div>
                <div class="h-2 my-2 w-16 bg-gray-200"></div>
                <div class="h-2 my-2 w-16 bg-gray-200"></div>
            </div>

            <div class="bg-gray-100 hidden flex-col rounded mt-3 p-2 text-sm w-full" id="dropdown">
                <a href="/home" class="text-2xl px-2 py-1 hover:bg-gray-200 rounded"> Home </a>
                <a href="/about" class="text-2xl px-2 py-1 hover:bg-gray-200 rounded"> About </a>
                <a href="/qualifications" class="text-2xl px-2 py-1 hover:bg-gray-200 rounded"> Qualifications </a>
                <a href="/projects" class="text-2xl px-2 py-1 hover:bg-gray-200 rounded"> Projects </a>
            </div>
        </div>

        <script>
            window.addEventListener('DOMContentLoaded', ()=> {
                const menuBtn = document.querySelector('#menu-btn')
                const dropdown = document.querySelector('#dropdown')
                menuBtn.addEventListener('click', () => {
                    dropdown.classList.toggle('hidden')
                    dropdown.classList.toggle('flex')
                })
            })
        </script>
    </div>
</div>
