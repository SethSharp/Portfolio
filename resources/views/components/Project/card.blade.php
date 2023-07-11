@props(['title', 'description', 'link'])

<div class="rounded-3xl shadow-lg custom2:flex flex-row w-full my-4">
    <div class="justify-center md:px-16 my-10 p-6">
        <div class="custom2:flex custom2:flex-col">
            <div>
                <h1 class="sm:ml-0 text-2xl md:text-3xl font-bold text-blue-800 inline-block">
                    {{ $title }}
                    <a class="sm:pr-4" href="https://github.com/SethSharp/{{ $link }}">
                        <img class="w-16 h-16 inline-block"
                             src="/images/github.png"
                             alt="git-hub-link">
                    </a>
                </h1>
                <p class="text-bold pt-4 sm:p-6">
                    {{ $slot }}
                </p>
            </div>
        </div>
    </div>
</div>
