<nav class="h-fit sm:py-4 z-10 w-full">
    <div class="h-full gap-6 justify-center hidden sm:flex">
        <div class="my-auto space-x-4">
            @foreach(getCurrentEBEnvironmentConfig()['nav_links'] as $link)
                <x-navigation.seth.link href="{{ $link['href'] }}" active="{{ $link['active'] }}">
                    {{ $link['name'] }}
                </x-navigation.seth.link>
            @endforeach
            @auth
                <a class="text-lg text-gray-500" href="{{ route('profile.edit') }}">
                    Profile
                </a>
            @endauth

            @role('admin')
            <a class="text-lg text-gray-500"
               href="{{ route('dashboard.blogs.index') }}">
                Dashboard
            </a>
            @endrole
        </div>
    </div>

    <div x-data="{ open: false }" class="sm:hidden">
        <div class="mx-4 relative">
            <div class="flex gap-6 py-3">
                <div x-on:click="open = ! open" class="hover:bg-gray-800 rounded transition cursor-pointer">
                    <x-icons.burger class="!size-10 !text-gray-500"/>
                </div>
            </div>
            <div x-show="open" @click.outside="open = false" x-transition class="flex justify-start mt-4 z-50">
                <div
                    class="bg-gray-100 w-full sm:w-1/2 z-50 absolute text-left shadow-2xl px-6 py-6 space-y-2 grid">
                    @foreach(getCurrentEBEnvironmentConfig()['nav_links'] as $link)
                        <x-navigation.seth.link href="{{ $link['href'] }}" active="{{ $link['active'] }}">
                            {{ $link['name'] }}
                        </x-navigation.seth.link>
                    @endforeach

                    @auth
                        <div class="border-t grid py-2 space-y-2">
                            <a class="font-medium text-gray-500 hover:underline" href="{{ route('profile.edit') }}">
                                Profile
                            </a>

                            @role('admin')
                            <a class="font-medium text-gray-500 hover:underline"
                               href="{{ route('dashboard.blogs.index') }}">
                                Dashboard
                            </a>
                            @endrole
                        </div>

                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
