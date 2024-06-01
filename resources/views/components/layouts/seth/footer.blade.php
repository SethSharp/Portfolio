<footer class="h-fit border-t-2 border-primary-500 bg-[#3E3D3D]">
    <div class="p-8">
        <div class="sm:flex space-y-4">
            <div class="sm:w-1/2 font-mono text-xl">
                <div>
                    <ul class="text-gray-400 pl-2 space-y-3 mt-4">
                        @foreach(getCurrentEBEnvironmentConfig()['nav_links'] as $link)
                            <li>
                                <x-navigation.seth.link href="{{ $link['href'] }}">
                                    {{ $link['name'] }}
                                </x-navigation.seth.link>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="sm:w-1/2 font-mono">
                <livewire:contact-component/>
            </div>
        </div>
    </div>

    <div class="p-4 flex justify-between">
        <p class="text-sm my-auto leading-5 text-gray-400">
            {!! getCurrentEBEnvironmentConfig()['copyright'] !!}
        </p>

        <div class="flex gap-4">
            @foreach(getCurrentEBEnvironmentConfig()['social_links'] as $link)
                <a href="{{ $link['link'] }}" class="flex text-gray-400 gap-4 my-2 hover:text-gray-900">
                    <img
                        class="size-8 transition ease-in-out delay-0 hover:-translate-y-1 duration-50"
                        src="{{ '/images/' . $link['image'] }}"
                        alt="{{ $link['alt'] }}"
                    >
                </a>
            @endforeach
        </div>
    </div>
</footer>

