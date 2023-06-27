@extends("layouts.main")

@section("content")
    <x-nav-bar home="text-black border-black"></x-nav-bar>
    <div class="w-full">
        <div class="pl-3 sm:pl-4 pt-16
                    md:pl-14
                    custom1:flex flex-row">
            <!-- Intro area -->
            <div class="pl-2 pt-32 md:pl-0 sm:pl-14
                        w-full z-10 relative
                        custom1:w-7/12 custom1:flex custom1:flex-col ">
                <!-- Intro text -->
                <div class="w-full">
                    <div class=" w-auto lg:float-right pr-12">
                        <h1 class="text-6xl font-bold"> G'day! </h1>
                        <div class="">
                            <h1 class="text-6xl font-bold inline-block pr-2"> I'm </h1>
                            <h1 class="text-6xl font-bold text-amber-400 inline-block text-opacity-19.5"> Seth
                                Sharp </h1>
                        </div>

                        <div class="pt-6 sm:pt-14">
                            <h1 class="text-gray-400 text-2xl"> Developer and outdoor enthusiast... </h1>
                            <h1 class="text-gray-400 text-2xl"> Weird match, right?</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile image -->
            <div class="sm:w-full custom1:w-8/12 w-full custom1:grow z-20 relative h-1/2">
                <div class="w-full">
                    <img class="z-20 relative w-auto h-full"
                         src="/images/profileTrans.png"
                         alt="profile-picture">
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <hr class="my-10 w-4/5"/>
        </div>

        <div>
            <div class="flex flex-wrap justify-center">
                <x-card.content-left
                    title="About Me Currently"
                    src="maheno.png"
                    content="My future career goals, which my experience at Coding labs has influenced my thought
                    process on. Is to become a highly experienced and knowledgeable developer at a company. With this
                    knowledge I want to be able to share that with other new developers like my self (in the future).
                    Surrounding myself with other experienced developers I found was highly impactful in how I want to
                    walk down my developer journey."
                />

                <x-card.content-right
                    title="About Me Currently"
                    src="car.jpg"
                    content="My future career goals, which my experience at Coding labs has influenced my thought
                    process on. Is to become a highly experienced and knowledgeable developer at a company. With this
                    knowledge I want to be able to share that with other new developers like my self (in the future).
                    Surrounding myself with other experienced developers I found was highly impactful in how I want to
                    walk down my developer journey."
                />
            </div>

            <div>
                <div class="text-center mt-8 w-full">
                    <h1 class="text-4xl font-bold text-black inline-block pr-2"> My </h1>
                    <h1 class="text-4xl font-bold text-blue-800 inline-block"> Links </h1>
                </div>

                <div class="pt-4 pb-5 text-center" id="contact">
                    <a class="pr-4" href="https://github.com/SethSharp">
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
    </div>
@stop
