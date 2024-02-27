<div class="z-50 h-20 mb-4 w-full float-right sm:pr-10">
    <div class="h-full
                inline-block align-middle
                -z-10 grid
                grid-rows-2 grid-cols-2
                sm:grid-rows-1 sm:grid-flow-col
                sm:float-right
                hidden
                sm:flex">
        <div class="bg-white bg-opacity-75 rounded-3xl w-fit h-fit p-2 my-auto">
            <a class="my-auto mx-auto text-xl font-bold text-center {{ request()->is('/') ? 'underline' : '' }}  underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400 hover:underline"
               href="/">
                About
            </a>

            <a class="my-auto mx-auto text-xl font-bold text-center {{ request()->is('experience') ? 'underline' : '' }} underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400 hover:underline"
               href="/experience">
                Experiences
            </a>

            <a class="my-auto mx-auto text-xl font-bold text-center {{ request()->is('capabilities') ? 'underline' : '' }} underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400 hover:underline"
               href="/capabilities">
                Capabilities
            </a>

            <a class="my-auto mx-auto text-xl font-bold text-center {{ request()->is('portfolio') ? 'underline' : '' }} underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400 hover:underline"
               href="/portfolio">
                Portfolio
            </a>

            <a class="my-auto mx-auto text-xl font-bold text-center {{ request()->is('blogs') ? 'underline' : '' }} underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400 hover:underline"
               href="/blogs">
                Blogs
            </a>
        </div>

        @auth()
            <div class="my-auto font-medium">
                <a href="{{ route('profile.edit') }}"> {{ auth()->user()->name }} </a>
            </div>
        @endauth
    </div>

    <div class="sm:hidden z-50">
        <div class="mx-8">
            <div class="rounded float-right mt-6" id="menu-btn">
                <div class="h-2 my-2 w-12 ml-3 bg-gray-400 opacity-50 rounded-lg"></div>
                <div class="h-2 my-2 w-16 bg-gray-400 opacity-50 rounded-lg"></div>
                <div class="h-2 my-2 w-12 ml-3 bg-gray-400 opacity-50 rounded-lg"></div>
            </div>

            <div class="bg-white relative shadow-2xl w-full hidden
                        flex-col rounded px-6 py-3 font-medium mt-24
                        text-center" id="dropdown">
                <a href="/about"
                   class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{ request()->is('/') ? 'underline' : '' }}">
                    About
                </a>

                <a href="/experience"
                   class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{ request()->is('experience') ? 'underline' : '' }}">
                    Experiences
                </a>

                <a href="/capabilities"
                   class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{ request()->is('capabilities') ? 'underline' : '' }}">
                    Capabilities
                </a>

                <a href="/portfolio"
                   class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{ request()->is('portfolio') ? 'underline' : '' }}">
                    Portfolio
                </a>

                <a href="/blogs"
                   class="border hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{ request()->is('blogs') ? 'underline' : '' }}">
                    Blogs
                </a>

                @auth()
                    <div class="my-auto font-medium mt-4">
                        <a href="{{ route('profile.edit') }}"> {{ auth()->user()->name }} </a>
                    </div>
                @endauth
            </div>
        </div>

        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const menuBtn = document.querySelector('#menu-btn')
                const dropdown = document.querySelector('#dropdown')
                menuBtn.addEventListener('click', () => {
                    dropdown.classList.toggle('hidden')
                    dropdown.classList.toggle('flex')
                });
            });
        </script>
    </div>
</div>
