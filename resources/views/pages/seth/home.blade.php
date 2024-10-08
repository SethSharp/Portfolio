@extends("layouts.main")

@section('title', 'Home - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Hey I am Seth Sharp, a Software Developer located in SE QLD on the Gold Coast. I have been a Software Developer over the last couple of years and have developed skills in multiple libraries and frameworks to push my best work">
@endpush

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap');
    </style>
@endpush

@section("content")
    <div class="w-full divide-y">
        <div class="md:flex md:mt-14 pb-12 md:pb-24 gap-y-12">
            <div class="md:w-1/2 md:mt-16 mx-auto md:ml-12 z-10">
                <div class="sm:mt-8 mx-auto w-fit">
                    <x-headings.seth.main>
                        <h1>
                            Seth Sharp
                        </h1>
                        <h2 class="pt-2 font-light">
                            Software
                        </h2>
                        <h2 class="pt-2 font-light">
                            Developer
                        </h2>
                    </x-headings.seth.main>
                </div>
            </div>
            <div class="md:w-1/2 p-2">
                <x-body.wrapper>
                    <img
                        class="object-cover mx-auto w-52 sm:w-96 mt-8 sm:mt-0"
                        src="{{ asset('/seth/profile-picture.png') }}"
                        alt="Profile Picture for Seth Sharp"
                    />
                </x-body.wrapper>
            </div>
        </div>

        <x-body.wrapper>
            <div class="py-12 md:py-24 text-center">
                <x-headings.seth.h2>
                    About me
                </x-headings.seth.h2>

                <div class="leading-loose p-4 md:w-2/3 mx-auto text-gray-300 text-lg">
                    <p>
                        I currently live on the Gold Coast and loving every moment. I love everything outdoors such as
                        4WDing, camping or fishing.
                        I also enjoy gaming from time to time to have a nice break from my busy life.
                    </p>

                    <br/>

                    <p>
                        Among work and play, I still love to build personal projects using the skills I have learnt over
                        the years.
                        Testing them in different applications - each setting new objectives and teaching new skills.
                    </p>

                    <div class="md:flex justify-center mt-12 space-y-4 md:space-y-0 gap-4 md:w-1/2 mx-auto">
                        <img src="{{ asset('/seth/about/4wd.png') }}" alt="4WD track in Ormeau"
                             class="size-52 object-cover mx-auto rounded-md"/>
                        <img src="{{ asset('/seth/about/lookout.png') }}" alt="Fraser Island Sand Dune on the West Side"
                             class="size-52 object-right object-cover mx-auto rounded-md"/>
                    </div>
                </div>
            </div>
        </x-body.wrapper>

        <x-body.wrapper>
            <div class="py-12 md:py-24 text-center">
                <x-headings.seth.h2>
                    My Specialisations
                </x-headings.seth.h2>

                <div>
                    <p class="leading-loose p-4 md:w-2/3 mx-auto text-gray-300 text-lg">
                        I have been a Junior Software Developer over the last
                        couple of years specialising in Laravel development.
                        I have developed skills in multiple libraries and frameworks to build custom
                        web applications for clients. See below, just to name a few:
                    </p>

                    <div id="technology-icons" class="flex gap-8 justify-center mt-12">
                        <x-icons.laravel/>
                        <x-icons.vue/>
                        <x-icons.livewire/>
                        <x-icons.tailwind/>
                    </div>
                </div>
            </div>
        </x-body.wrapper>


        <x-body.wrapper>
            <div class="py-12 md:py-24 text-center">
                <x-headings.seth.h2>
                    Aspiration
                </x-headings.seth.h2>

                <div>
                    <p class="leading-loose p-4 md:w-2/3 mx-auto text-gray-300 text-lg">
                        One of my major aspirations is to start my own business. I am eager to leverage my skills and
                        experience to create innovative solutions and build a successful venture
                    </p>
                </div>
            </div>
        </x-body.wrapper>
    </div>
@stop
