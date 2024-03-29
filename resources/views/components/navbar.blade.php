<nav class="h-20 w-full bg-white sm:pr-10">
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
                Home
            </a>

            <a class="my-auto mx-auto text-xl font-bold text-center {{ request()->is('projects') ? 'underline' : '' }} underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400 hover:underline"
               href="/projects">
                Projects
            </a>

            <a class="my-auto mx-auto text-xl font-bold text-center {{ request()->is('experience') ? 'underline' : '' }} underline-offset-4 p-2.5
                   rounded-3xl hover:-translate-y-1 transition delay-75 duration-400 hover:underline"
               href="/experience">
                Experiences
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

    <div class="sm:hidden">
        <div class="mx-8">
            <div class="flex mt-4">
                <div class="my-auto text-3xl text-gray-400">
                    Seth Sharp
                </div>

                <div class="rounded ml-auto hover:bg-gray-300 transition p-1 cursor-pointer" id="menu-btn">
                    <div class="h-2 my-2 w-12 ml-3 bg-gray-400 opacity-50 rounded-lg"></div>
                    <div class="h-2 my-2 w-16 bg-gray-400 opacity-50 rounded-lg"></div>
                    <div class="h-2 my-2 w-12 ml-3 bg-gray-400 opacity-50 rounded-lg"></div>
                </div>
            </div>

            <div class="bg-white z-50 relative shadow-2xl w-full hidden
                        flex-col rounded px-6 py-3 font-medium mt-4
                        text-center" id="dropdown">
                <a href="/"
                   class="border transition hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{ request()->is('/') ? 'underline' : '' }}">
                    Home
                </a>

                <a href="/projects"
                   class="border transition hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{ request()->is('projects') ? 'underline' : '' }}">
                    Projects
                </a>

                <a href="/experience"
                   class="border transition hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{ request()->is('experience') ? 'underline' : '' }}">
                    Experiences
                </a>

                <a href="/blogs"
                   class="border transition hover:bg-black hover:text-white active:bg-black active:font-white text-2xl px-2 py-1 hover:bg-gray-200 rounded {{ request()->is('blogs') ? 'underline' : '' }}">
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
</nav>
