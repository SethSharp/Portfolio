@extends("layouts.main")

@section('title', 'Home - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Hey I am Seth Sharp, a Junior Software developer at Coding Labs on the Gold Coast. I love to build ambitious projects and love the art of programming.">
@endpush

@push('links')
    <link rel="icon" href="{{ asset('/seth/favicon.ico') }}" type="image/x-icon">
@endpush

@section("content")
    <div class="z-10">
        <x-body.enter-wrapper>
            <div class="w-full md:flex ">
                <div class="w-full md:w-1/2 z-20 justify-center">
                    <h1 class="text-6xl font-bold text-gray-800"> G'day! </h1>

                    <div class="pt-2">
                        <h1 class="text-6xl font-bold inline-block pr-2 text-gray-800"> I'm </h1>
                        <h1 class="text-6xl font-bold text-primary-400 inline-block text-opacity-19.5"> Seth
                            Sharp </h1>
                    </div>

                    <div class="pt-6 sm:pt-14">
                        <h1 class="text-gray-400 text-2xl"> Developer and outdoor enthusiast... </h1>
                        <h1 class="text-gray-400 text-2xl"> Weird match, right? </h1>
                    </div>

                    <div class="pt-4 pb-5">
                        <a class="pr-2" href="https://github.com/SethSharp">
                            <img
                                class="w-16 h-16 inline-block
                                transition ease-in-out delay-0
                                hover:-translate-y-1 duration-50"
                                src="{{ asset('images/github.png') }}"
                                alt="GitHub Image"
                            >
                        </a>
                        <a href="https://www.linkedin.com/in/seth-sharp-213bb3211/">
                            <img
                                class="w-11 h-11 inline-block
                                transition ease-in-out delay-0
                                hover:-translate-y-1 duration-50"
                                src="{{ asset('images/linkedIn.png') }}"
                                alt="LinkedIn Image"
                            >
                        </a>
                    </div>
                </div>

                <div class="w-full md:w-1/2 z-20 flex justify-center">
                    <img
                        class="max-h-96"
                        src="{{ asset('images/about/sydney.png') }}"
                        alt="Main Profile Picture - Infront of the Sydney Opera House"
                    />
                </div>
            </div>
        </x-body.enter-wrapper>

        <div class="mt-6">
            @if ($blogs->isNotEmpty())
                <x-body.wrapper>
                    <h3 class="text-xl text-center">
                        My Most Recent Blogs
                    </h3>

                    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:w-3/4 mx-auto gap-4 mt-6">
                        @foreach($blogs as $blog)
                            <x-arch :blog="$blog"/>
                        @endforeach
                    </div>
                </x-body.wrapper>
            @endif
        </div>

        <div class="mt-16">
            <div class="flex flex-wrap space-y-12">
                <x-content.left
                    title="About Me Currently"
                    src="about/4wd.png"
                    alt="4WD track with car coming down hill."
                    caption="4WD track in Ormeau"
                >
                    <p>
                        I currently reside on the Gold Coast and work as a Junior Software Developer at Coding
                        Labs. I have been really enjoying the last year or so working in the field and have learnt so
                        much. My primary tech stack includes Laravel, Vue, Inertia, JS/TS,
                        Alpine, Livewire, and Tailwind CSS.
                    </p>
                </x-content.left>

                <x-content.right
                    title="Aspirations"
                    src="about/harbour.png"
                    alt="Standing under the Sydney Harbour Bridge."
                    caption="Sydney Trip"
                >
                    <p>
                        One of my major aspirations is to start my own business. I am eager to leverage my skills and
                        experience to create innovative solutions and build a successful venture. But until then when I
                        am experienced enough, I aim to
                        grow in my career and become a lead developer, taking on more responsibilities and leading
                        impactful projects.
                    </p>
                </x-content.right>

                <x-content.left
                    title="Extra things about me"
                    src="about/lookout.png"
                    alt="Fraser Island West Side lookout on top of a massive dune."
                    caption="Fraser Island - West Side"
                >
                    <p>
                        Apart from my professional and career aspirations, I am a big fan of outdoor adventures. Whether
                        it's exploring the scenic views of Fraser Island or tackling challenging 4WD tracks or catching
                        nothing when I go fishing.
                    </p>
                    <p>
                        I also have a passion for gaming. Whenever I get some free time, I love diving into immersive
                        games that offer a great escape and entertainment. It's a fun and relaxing way to unwind and
                        enjoy some downtime.
                    </p>
                </x-content.left>

            </div>
        </div>
    </div>
@stop
