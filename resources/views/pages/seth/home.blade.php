@extends("layouts.main")

@section('title', 'Home - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Hey I am Seth Sharp, a Junior Software developer at Coding Labs on the Gold Coast. I love to build ambitious projects and love the art of programming.">
@endpush

@push('links')
    <link rel="icon" href="{{ asset('/seth/favicon.ico') }}" type="image/x-icon">
@endpush

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap');
    </style>
@endpush

@section("content")
    <div class="w-full">
        <div class="md:flex mt-14">
            <div class="md:w-1/2 text-6xl font-mono mt-16 ml-12 text-white">
                <h1 class="font-semibold track-wide">
                    Seth Sharp
                </h1>
                <h2 class="pt-2 font-light">
                    Software
                </h2>
                <h2 class="pt-2 font-light">
                    Developer
                </h2>
            </div>
            <div class="md:w-1/2 p-2">
                <img
                    class="object-cover mx-auto w-96"
                    src="{{ asset('/seth/profile-picture.jpg') }}"
                    alt="Profile Picture for Seth Sharp"
                />
            </div>
        </div>
    </div>
@stop
