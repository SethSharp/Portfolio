<footer class="h-fit border-t-2 border-primary-500">
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

            <div class="sm:w-1/2 px-2 sm:px-8 bg-gray-600 rounded py-2 font-mono">
                <h1 class="text-xl font-medium mb-2 text-primary-900"> Contact Me </h1>

                <livewire:contact-component/>
            </div>
        </div>
    </div>

    <div class="p-4 flex justify-start">
        <p class="text-sm my-auto leading-5 text-gray-400">
            {!! getCurrentEBEnvironmentConfig()['copyright'] !!}
        </p>
    </div>
</footer>

