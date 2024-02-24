@extends("layouts.main")

@section("content")
    <div class="z-10">
        <div class="w-full">
            <a href="/blogs" class="w-3/4 mx-auto">
                <div
                    class="w-full p-4 border-2 border-blue-400 bg-blue-100 rounded-xl text-blue-600"
                >
                    New blog added!
                </div>
            </a>
        </div>

        <div class="w-full md:flex mt-12">
            <div class="w-full md:w-1/2 z-20 justify-center">
                <h1 class="text-6xl font-bold text-gray-800"> G'day! </h1>

                <div class="pt-2">
                    <h1 class="text-6xl font-bold inline-block pr-2 text-gray-800"> I'm </h1>
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
                            src="/images/github.png"
                            alt="GitHub Image"
                        >
                    </a>
                    <a href="https://www.linkedin.com/in/seth-sharp-213bb3211/">
                        <img
                            class="w-11 h-11 inline-block
                                    transition ease-in-out delay-0
                                    hover:-translate-y-1 duration-50"
                            src="/images/linkedIn.png"
                            alt="LinkedIn Image"
                        >
                    </a>
                </div>
            </div>

            <div class="w-full md:w-1/2 z-20 flex justify-center">
                <img
                    class="h-3/4"
                    src="/images/about/sydney.png"
                    alt="Main Profile Picture - Infront of the Sydney Opera House"
                />
            </div>
        </div>

        <div class="mt-16 md:mt-0">
            <div class="flex flex-wrap justify-center">
                <x-content.left
                    title="About Me Currently"
                    src="about/4wd.png"
                    alt="4WD track track with car coming down hill."
                    caption="4WD track in Ormeau"
                >
                    I am currently living it up on the Gold Coast and enjoying every bit. I am working with Coding Labs
                    and working in a sub-team focusing on coding, infrastructure and incident reporting. Mainly focusing
                    on using our preferred tech stacks to bring the best product we can to our clients.
                </x-content.left>

                <x-content.right
                    title="Aspirations"
                    src="about/harbour.png"
                    alt="Standing under the Sydney Harbour Bridge."
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
                </x-content.right>

                <x-content.left
                    title="Extra things about me"
                    src="about/lookout.png"
                    alt="Fraser Island West Side lookout on top of a massive dune."
                    caption="Fraser Island - West Side"
                >
                    In my spare time I enjoy the outdoors by going 4WDing on bush tracks and beautiful national
                    parks such as Fraser Island. As well camping and staying away from technology for as long as
                    possible.
                </x-content.left>
            </div>
        </div>
    </div>
@stop
