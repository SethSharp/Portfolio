@extends("layouts.main")

@section("content")
    <div id="drop-down"
         class="hidden absolute z-20 flex justify-center w-full h-full
                backdrop-blur-sm bg-white/30">
        <div class="overflow-scroll overflow-y-hidden overflow-x-hidden
                    fixed z-30 bg-white border mt-8 z-30
                    w-1/3 h-auto
                    rounded-3xl text-center
                ">
            <h1 class="font-medium text-2xl text-black pt-4"> Send me a message! </h1>
            <div class="p-5">
                <form method="POST" action="/home">
                    @method('POST')
                    @csrf
                    <div class="mb-4">
                        <label class="font-bold text-gray-800" for="name"> Name </label>
                        <br>
                        <input class="h-10 bg-white border border-2 border-gray-300 rounded py-4 px-3 mr-4 w-1/2
                              text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="name"
                               name="name" autofocus autocomplete="off">
                    </div>

                    <div class="mb-4">
                        <label class="font-bold text-gray-800" for="name"> Subject </label>
                        <br>
                        <input class="h-10 bg-white border border-2 border-gray-300 rounded py-4 px-3 mr-4 w-1/2
                              text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="name"
                               name="name" autocomplete="off">
                    </div>

                    <div class="mb-4">
                        <label class="font-bold text-gray-800" for="body"> Body: </label>
                        <br>
                        <textarea class="h-36 bg-white border border-2 border-gray-300 rounded py-4 px-3 mr-4 w-3/4
                              text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="body"
                                  name="body" autocomplete="off">  </textarea>
                    </div>

                    <button class="bg-green-500 text-white tracking-wide px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow">
                        Send!
                    </button>
                </form>
            </div>
            <p id="close-btn" class="mb-6"> <u> close </u></p>
        </div>
    </div>

    <x-nav-bar home="text-black border-black"></x-nav-bar>
    <div class="h-20"></div>
    <div class="w-full">
        <div class="pl-3 sm:pl-4
                    md:pl-14 z-0
                    custom1:flex flex-row">

            {{-- Intro area --}}
            <div class="pl-2 pb-4 pt-8
                        md:pl-0 sm:pl-14
                        w-full
                        custom1:w-7/12
                        custom1:flex
                        custom1:flex-col">
                {{--Intor text--}}
                <div class="pl-2">
                    <div class="">
                        <h1 class="text-6xl font-bold"> Hi! </h1>
                    </div>
                    <div class="">
                        <h1 class="text-6xl font-bold inline-block pr-2"> I'm </h1>
                        <h1 class="text-6xl font-bold text-amber-400 inline-block text-opacity-19.5">  Seth Sharp </h1>
                    </div>

                    <div class="pt-14">
                        <h1 class="text-gray-400 text-2xl"> Developer by day </h1>
                        <h1 class="text-gray-400 text-2xl"> Pizza Thrower by night</h1>
                    </div>
                    <button id="contact-btn" class="bg-blue-800 text-3xl text-white rounded-3xl w-48 mt-4
                               transition ease-in-out delay-0
                               p-1.5
                               hover:-translate-y-1 hover:scale-100 duration-50">
                        Hire me!
                    </button>



                    <script>
                        window.addEventListener('DOMContentLoaded', ()=> {
                            const contactBtn = document.querySelector('#contact-btn')
                            const contactCard = document.querySelector('#drop-down')
                            const closeBtn = document.querySelector('#close-btn');
                            contactBtn.addEventListener('click', () => {
                                contactCard.classList.toggle('hidden');
                            });
                            closeBtn.addEventListener('click', () => {
                                contactCard.classList.toggle('hidden');
                            });
                        })
                    </script>
                </div>

                {{--Links--}}
                <div class="pt-14 pb-5">
                    <a class="pr-4" href="https://github.com/SethSharp">
                        <img class="w-16 h-16 inline-block
                                    transition ease-in-out delay-0
                                    hover:-translate-y-1 hover:scale-75 duration-50
                                    " src="/images/github_bgremoval.ai.png" alt="git-hub-link">
                    </a>
                    <a href="https://www.linkedin.com/in/seth-sharp-213bb3211/">
                        <img class="w-11 h-11 inline-block
                                    transition ease-in-out delay-0
                                    hover:-translate-y-1 hover:scale-75 duration-50"
                                    src="/images/linkedInNew.png" alt="git-hub-link">
                    </a>
                </div>
            </div>

            {{-- Profile image --}}
            <div class="sm:w-full custom1:w-8/12 w-full custom1:grow z-0 relative overflow-hidden">
                <div class="h-full w-full">
                    <img class="
                                relative z-20
                                w-auto h-auto"
                         src="/images/profileTrans.png"
                         alt="profile-picture">

                </div>

                {{--Upper rectangles--}}
                <div class="w-1/2 h-6 absolute -top-1/4 ml-16 sm:ml-10 animate-rectDownFast">
                    <div class="w-full h-full bg-amber-400 rounded-3xl -rotate-[50deg] opacity-30"></div>
                </div>
                <div class="w-1/4 h-6 absolute top-3/4 -ml-36 sm:-ml-52 animate-rectUpSlow opacity-30">
                    <div class="w-full h-full bg-amber-400 rounded-3xl -rotate-[50deg] opacity-60"></div>
                </div>
                <div class="w-1/2 h-6 absolute top-3/4 -ml-80 animate-rectUpMed">
                    <div class="w-full h-full bg-amber-400 rounded-3xl -rotate-[50deg] opacity-60"></div>
                </div>

                {{--Lower rectangle--}}
                <div class="w-1/4 h-6 absolute top-3/4 ml-44 sm:ml-64 animate-rectUpSlow">
                    <div class="w-full h-full bg-blue-400 rounded-3xl -rotate-[50deg]"></div>
                </div>
                <div class="w-2/3 h-6 absolute top-full ml-20 sm:ml-28 animate-rectUpFast">
                    <div class="w-full h-full bg-blue-400 rounded-3xl -rotate-[50deg] opacity-30"></div>
                </div>
                <div class="w-1/2 h-6 absolute top-1/4 right-0 -mr-52 sm:-mr-64 animate-rectDownSlow">
                    <div class="w-full h-full bg-blue-400 rounded-3xl -rotate-[50deg] opacity-75"></div>
                </div>

            </div>
        </div>
    </div>
@stop
