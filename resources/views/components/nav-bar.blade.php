@props(['home' => 'text-gray-800'])
@props(['about' => 'text-gray-800'])
@props(['qualifications' => 'text-gray-800'])
@props(['projects' => 'text-gray-800'])

<div class="h-4"></div>
<div class="bg-gray-50 justify-items-center
            -z-10 grid
            grid-rows-2 grid-cols-2
            sm:grid-rows-1 sm:grid-flow-col
            sm:float-right">
    <h1 class="text-2xl text-center {{$home}} border-2 p-2.5 border-transparent hover:border-2 hover:rounded-3xl hover:border-black hover:animate-fade">
        <a href="/home"> Home </a>
    </h1>
    <h1 class="text-2xl text-center {{$about}} border-2 p-2.5 border-transparent hover:border-2 hover:rounded-3xl hover:border-black hover:animate-fade">
        <a href="/about"> About </a>
        <h1/>
    <h1 class="text-2xl text-center {{$qualifications}} border-2 p-2.5 border-transparent hover:border-2 hover:rounded-3xl hover:border-black hover:animate-fade">
        <a href="/qualifications"> Qualifications </a>
        <h1/>
    <h1 class="text-2xl text-center {{$projects}} border-2 p-2.5 border-transparent hover:border-2 hover:rounded-3xl hover:border-black hover:animate-fade">
        <a href="/projects"> Projects </a>
    </h1>
</div>
