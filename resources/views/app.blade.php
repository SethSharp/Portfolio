@extends("layouts.main")

@section("content")

    <x-nav-bar home="text-black border-black"></x-nav-bar>

    <div class="w-full">
        <div class="flex pt-32
                    h-3/4 w-3/4 m-auto flex-col md:flex-row">
            <!-- Intro area -->
            <div class="w-full z-10 my-16">
                <!-- Intro text -->
                <div class="w-auto">
                    <h1 class="text-6xl font-bold"> G'day! </h1>
                    <div class="pt-2">
                        <h1 class="text-6xl font-bold inline-block pr-2"> I'm </h1>
                        <h1 class="text-6xl font-bold text-amber-400 inline-block text-opacity-19.5">
                            Seth Sharp
                        </h1>
                    </div>

                    <div class="pt-6 sm:pt-14">
                        <h1 class="text-gray-400 text-2xl"> Developer and outdoor enthusiast... </h1>
                        <h1 class="text-gray-400 text-2xl"> Weird match, right?</h1>
                    </div>

                    <div class="pt-4 pb-5">
                        <a class="pr-2" href="https://github.com/SethSharp">
                            <img class="w-16 h-16 inline-block
                                transition ease-in-out delay-0
                                hover:-translate-y-1 duration-50
                                " src="/images/github_bgremoval.ai.png" alt="git-hub-link">
                        </a>
                        <a href="https://www.linkedin.com/in/seth-sharp-213bb3211/">
                            <img class="w-11 h-11 inline-block
                                transition ease-in-out delay-0
                                hover:-translate-y-1 duration-50"
                                 src="/images/linkedInNew.png" alt="git-hub-link">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile image -->
            <div class="w-full z-20 flex justify-center">
                <img
                    class="h-full"
                    src="/images/profile.png"
                    alt="profile-picture"
                >
            </div>
        </div>

        <div class="flex justify-center">
            <hr class="my-8 w-4/5"/>
        </div>

        <div>
            <div class="flex flex-wrap justify-center">
                <x-card.content-right
                    title="About Me Currently"
                    src="maheno.png"
                    content="My future career goals, which my experience at Coding labs has influenced my thought
                    process on. Is to become a highly experienced and knowledgeable developer at a company. With this
                    knowledge I want to be able to share that with other new developers like my self (in the future).
                    Surrounding myself with other experienced developers I found was highly impactful in how I want to
                    walk down my developer journey."
                />

                <x-card.content-left
                    title="About Me Currently"
                    src="harbour.png"
                    content="My future career goals, which my experience at Coding labs has influenced my thought
                    process on. Is to become a highly experienced and knowledgeable developer at a company. With this
                    knowledge I want to be able to share that with other new developers like my self (in the future).
                    Surrounding myself with other experienced developers I found was highly impactful in how I want to
                    walk down my developer journey."
                />
            </div>
        </div>
    </div>
@stop
