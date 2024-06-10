<header class="w-full h-fit bg-red-50 flex justify-center">
    <div class="mt-12 mb-6 text-center">
        <div class="tracking-widest">
            <div class="text-3xl md:text-5xl text-primary-800 mb-2">
                Bethany Frankis
            </div>
        </div>

        <div class="px-4 mx-auto">
            <div class="gap-2 sm:gap-8 grid sm:grid-cols-2 lg:grid-cols-4 mt-10">
                @foreach(getCurrentEBEnvironmentConfig()['nav_links'] as $link)
                    <x-navigation.beth.link href="{{ $link['href'] }}" active="{{ $link['active'] }}">
                        {{ $link['name'] }}
                    </x-navigation.beth.link>
                @endforeach
            </div>

            @auth
                <div class="mt-4 gap-6 md:grid-cols-2">
                    <x-navigation.beth.link class="font-medium text-gray-500 hover:underline"
                                            href="{{ route('profile.edit') }}" active="{{false}}">
                        Profile
                    </x-navigation.beth.link>

                    @role('admin')
                    <x-navigation.beth.link class="font-medium text-gray-500 hover:underline"
                                            href="{{ route('dashboard.blogs.index') }}" active="{{ false }}">
                        Dashboard
                    </x-navigation.beth.link>
                    @endrole
                </div>

            @endauth
        </div>
    </div>
</header>
