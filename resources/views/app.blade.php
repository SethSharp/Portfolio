@extends("layouts.main")

@section("content")

    <x-nav-bar home="text-black border-black"></x-nav-bar>

    <div class="w-full">
        <div class="md:flex mt-2 pt-1 mt-8 md:pt-24 w-3/4 m-auto">
            <!-- Intro area -->
            <div class="w-full md:w-1/2 z-10 my-16 flex flex-col">
                <!-- Intro text -->
                <div class="w-auto">
                    <h1 class="text-6xl font-bold"> G'day! </h1>
                    <div class="pt-2">
                        <h1 class="text-6xl font-bold inline-block pr-2"> I'm </h1>
                        <h1 class="text-6xl font-bold text-amber-400 inline-block text-opacity-19.5"> Seth Sharp </h1>
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
                                src="/images/github.png" alt="git-hub-link"
                            >
                        </a>
                        <a href="https://www.linkedin.com/in/seth-sharp-213bb3211/">
                            <img
                                class="w-11 h-11 inline-block
                                        transition ease-in-out delay-0
                                        hover:-translate-y-1 duration-50"
                                src="/images/linkedIn.png" alt="git-hub-link"
                            >
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile image -->
            <div class="w-full md:w-1/2 z-20 flex justify-center">
                <img
                    class="h-3/4"
                    src="/images/profile.png"
                    alt="profile-picture"
                >
            </div>
        </div>


        <div class="mt-16 md:mt-0">
            <div class="flex flex-wrap justify-center">
                <x-card.content-right
                    title="About Me Currently"
                    src="4wd.png"
                    caption="4WD track in Ormeau"
                >
                    I am currently living it up on the Gold Coast and enjoying every bit. I am working with Coding Labs
                    and working in a sub-team focusing on coding, infrastructure and incident reporting. Mainly focusing
                    on
                    using our preferred tech stacks to bring the best product we can to our clients.
                </x-card.content-right>

                <x-card.content-left
                    title="Aspirations"
                    src="harbour.png"
                    caption="Sydney Trip"
                >
                    After some time in the industry and finishing my degree, I have a few aspirations in mind, but one
                    that sticks out most to me is starting a business in the technology field. It came up in a
                    conversation
                    and has stuck with me since and is something that is growing as a goal for my future.
                    But until that day when I am experienced enough I am currently enjoying
                    my
                    current position at Coding Labs and the journey going through my beginner stages as a developer
                    and hope to become experienced enough to lead other developers and coach/guide others who were in my
                    shoes.
                </x-card.content-left>

                <x-card.content-right
                    title="Extra things about me"
                    src="lookout.png"
                    caption="Fraser Isalnd - West Side"
                >
                    In my spare time I enjoy the outdoors by going 4wding on bush tracks and beaufitul national
                    parks such as Fraser Island. As well camping and staying away from technology for as long as
                    possible.
                </x-card.content-right>
            </div>
        </div>
    </div>
@stop
