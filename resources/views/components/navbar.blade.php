<nav class="h-20 w-full bg-white sm:pr-10">
    <div class="h-full gap-6 float-right hidden sm:flex">

        <div class="my-auto space-x-4">
            @foreach(getCurrentEBEnvironmentConfig()['nav_links'] as $link)
                <x-navigation.link href="{{ $link['href'] }}" active="{{ $link['active'] }}">
                    {{ $link['name'] }}
                </x-navigation.link>
            @endforeach
        </div>

        <div class="my-auto space-x-1">
            @auth
                <a class="font-medium text-xl text-gray-500 hover:underline my-auto" href="{{ route('profile.edit') }}">
                    Profile
                </a>
            @endauth

            @role('admin')
            <a class="font-medium text-xl text-gray-500 my-auto hover:underline"
               href="{{ route('dashboard.blogs.index') }}">
                Dashboard
            </a>
            @endrole
        </div>
    </div>

    <div x-data="{ open: false }" class="sm:hidden">
        <div class="mx-8 relative">
            <div class="flex gap-6 mt-4">
                <div x-on:click="open = ! open" class="hover:bg-gray-200 rounded transition cursor-pointer">
                    <x-icons.burger class="!size-10"/>
                </div>
                <a href="{{route('home')}}" class="my-auto text-3xl text-gray-600">
                    {{ getCurrentEBEnvironmentConfig()['in_app_name'] }}
                </a>
            </div>
            <div x-show="open" @click.outside="open = false" x-transition class="flex justify-start mt-4 z-50">
                <div
                    class="bg-gray-100 w-full sm:w-1/2 z-50 absolute text-left shadow-2xl px-6 py-6 space-y-2 grid">
                    @foreach(getCurrentEBEnvironmentConfig()['nav_links'] as $link)
                        <x-navigation.link href="{{ $link['href'] }}" active="{{ $link['active'] }}">
                            {{ $link['name'] }}
                        </x-navigation.link>
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
