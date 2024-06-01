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
    <div class="w-full divide-y">
        <div class="md:flex mt-14 pb-24">
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

        <div class="py-24 text-center">
            <h2 class="text-4xl font-mono text-gr text-white">
                My Specialisations
            </h2>

            <div>
                <p class="leading-loose p-4 w-2/3 mx-auto text-gray-300">
                    I currently reside in SE QLD on the Gold Coast. I have been a Software Developer over the last
                    couple of years and have developed skills in multiple libraries and frameworks to push my best work
                    - both personally and professionally.
                </p>

                <div id="technology-icons" class="flex gap-8 justify-center mt-12">
                    <x-icons.laravel/>
                    <x-icons.vue/>
                    <x-icons.livewire/>
                    <x-icons.aws/>
                    <x-icons.tailwind/>
                </div>
            </div>
        </div>

        <div class="py-24 text-center">
            <h2 class="text-4xl font-mono text-gr text-white">
                Aspiration
            </h2>

            <div>
                <p class="leading-loose p-4 w-2/3 mx-auto text-gray-300">
                    One of my major aspirations is to start my own business. I am eager to leverage my skills and
                    experience to create innovative solutions and build a successful venture
                </p>
            </div>
        </div>

        <div class="py-24 text-center">
            <h2 class="text-4xl font-mono text-gr text-white">
                More about me
            </h2>

            <div class="leading-loose p-4 w-2/3 mx-auto text-gray-300">
                <p>
                    I am a big fan of outdoor adventures. Whether it's exploring the scenic views of Fraser Island or
                    tackling challenging 4WD tracks or catching nothing when I go fishing.
                </p>

                <br>

                <p>
                    I also have a passion for gaming. Whenever I get some free time, I love diving into immersive games
                    that offer a great escape and entertainment. It's a fun and relaxing way to unwind and enjoy some
                    downtime.
                </p>

                <div class="flex justify-center mt-12 gap-6 w-1/2 mx-auto">
                    <img src="{{ asset('/seth/about/4wd.png') }}" alt="" class="size-52 object-cover rounded-md"/>
                    <img src="{{ asset('/seth/about/lookout.png') }}" alt=""
                         class="size-52 object-right object-cover rounded-md"/>
                </div>
            </div>
        </div>
    </div>
@stop
