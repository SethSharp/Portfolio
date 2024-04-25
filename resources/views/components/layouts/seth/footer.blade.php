<footer class="bg-gray-100 h-fit border-t-2 border-primary-700">
    <div class="p-8">
        <div class="sm:flex space-y-4">
            <div class="sm:w-1/2 font-bold text-xl">
                <div class="flex">
                    {{ getCurrentEBEnvironmentConfig()['in_app_name'] . ' Portfolio' }}
                </div>
                <div>
                    <ul class="text-gray-500 pl-2 space-y-3 mt-4">
                        @foreach(getCurrentEBEnvironmentConfig()['nav_links'] as $link)
                            <li>
                                <a class="text-lg hover:underline underline-offset-4 transition"
                                   href="{{ $link['href'] }}">
                                    {{ $link['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="sm:w-1/2 px-2 sm:px-8 bg-gray-200 rounded py-2">
                <h1 class="text-xl font-medium mb-2 text-primary-900"> Contact Me </h1>

                <livewire:contact-component/>
            </div>
        </div>
    </div>

    <div class="p-4 grid grid-cols-2">
        <p class="text-sm my-auto leading-5 text-gray-600">
            {!! getCurrentEBEnvironmentConfig()['copyright'] !!}
        </p>

        <div class="flex gap-4 justify-end">
            @foreach(getCurrentEBEnvironmentConfig()['social_links'] as $link)
                <a href="{{ $link['link'] }}">
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

