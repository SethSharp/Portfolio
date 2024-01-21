@extends("layouts.main")

@section("content")
    <x-nav-bar projects="text-black border-black" />

    <div class="mt-2 pt-1 md:mt-8 md:pt-4">
        <x-title title1="My" title2="Projects"/>
    </div>

    <div class="w-full sm:mt-5 sm:py-5 px-10 sm:px-28">
        <x-project.habit-tracker/>

        <x-project.framed/>
    </div>
@stop
