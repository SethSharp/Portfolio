<footer class="bg-gray-100 h-fit border-t-2 border-blue-500">
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
                <h1 class="text-xl font-medium mb-2"> Contact </h1>

                @if (session()->has('success'))
                    <div class="text-green-500">
                        {{ session('success') }}
                    </div>
                @endif

                <div>
                    <form wire:submit.prevent="send" class="space-y-2">
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <input
                                    type="text"
                                    class="p-2 w-full rounded-xl text-gray-500 border-none"
                                    placeholder="Email"
                                    wire:model.lazy="email"
                                    wire:ignore
                                >
                                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <input
                                    type="text"
                                    class="p-2 w-full rounded-xl text-gray-500 border-none"
                                    placeholder="Name"
                                    wire:model.lazy="name"
                                    wire:ignore
                                >
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <textarea
                                type="text"
                                class="p-2 h-28 w-full rounded-xl text-gray-500 border-none"
                                placeholder="Your message..."
                                wire:model.lazy="message"
                                wire:ignore
                            ></textarea>

                            @error('message') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end">
                            <x-button.primary type="submit">
                                Send
                            </x-button.primary>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 grid grid-cols-2">
        <p class="text-sm my-auto leading-5 text-gray-600">
            {!! getCurrentEBEnvironmentConfig()['copyright'] !!}
        </p>

        <div class="flex space-x-2 justify-end">
            @foreach(getCurrentEBEnvironmentConfig()['social_links'] as $link)
                <a href="{{ $link['link'] }}">
                    <img
                        class="size-9 inline-block transition ease-in-out delay-0 hover:-translate-y-1 duration-50"
                        src="{{ '/images/' . $link['image'] }}"
                        alt="{{ $link['alt'] }}"
                    >
                </a>
            @endforeach
        </div>
    </div>
</footer>

