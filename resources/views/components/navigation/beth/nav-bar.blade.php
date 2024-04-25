<header class="w-full h-fit bg-primary-50 flex justify-center">
    <div class="mt-12 mb-6 text-center">
        <div class="tracking-widest leading-loose">
            <div class="text-3xl md:text-5xl text-primary-800">
                Bethany Frankis
            </div>
            <span class="text-sm md:text-md text-black">
                Resilient. Intuitive. Perservant
            </span>
        </div>

        <div class="px-4 mx-auto">
            <div class="gap-2 sm:gap-8 grid sm:grid-cols-2 lg:grid-cols-4 mt-10">
                @foreach(getCurrentEBEnvironmentConfig()['nav_links'] as $link)
                    <x-navigation.beth.link href="{{ $link['href'] }}" active="{{ $link['active'] }}">
                        {{ $link['name'] }}
                    </x-navigation.beth.link>
                @endforeach
            </div>
        </div>
    </div>
</header>
