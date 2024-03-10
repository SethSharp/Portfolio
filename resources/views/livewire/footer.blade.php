<footer class="bg-gray-100 h-fit border-t-2 border-blue-500">
    <div class="p-8">
        <div class="sm:flex space-y-4">
            <div class="sm:w-1/2 font-bold text-xl">
                <div class="flex">
                    <p>Seth Sharp </p>
                    <p class="pl-1 text-primary-500"> Portfolio</p>
                </div>
                <div>
                    <ul class="text-gray-500 pl-2 space-y-3 mt-4">
                        <li>
                            <a class="text-lg hover:underline underline-offset-4 transition"
                               href="/">
                                About
                            </a>
                        </li>

                        <li>
                            <a class="text-lg hover:underline underline-offset-4 transition"
                               href="/experience">
                                Experiences
                            </a>
                        </li>

                        <li>
                            <a class="text-lg hover:underline underline-offset-4 transition"
                               href="/capabilities">
                                Capabilities
                            </a>
                        </li>

                        <li>
                            <a class="text-lg hover:underline underline-offset-4 transition"
                               href="/portfolio">
                                Portfolio
                            </a>
                        </li>

                        <li>
                            <a class="text-lg hover:underline underline-offset-4 transition"
                               href="/blogs">
                                Blogs
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="sm:w-1/2 px-8 bg-gray-200 rounded pt-4">
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
                                    placeholder="Name"
                                    wire:model.lazy="name"
                                    wire:ignore
                                >
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <input
                                    type="text"
                                    class="p-2 w-full rounded-xl text-gray-500 border-none"
                                    placeholder="Subject"
                                    wire:model.lazy="subject"
                                    wire:ignore
                                >
                                @error('subject') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <textarea
                                type="text"
                                class="p-2 h-28 w-full rounded-xl text-gray-500 border-none"
                                placeholder="Your enquiry..."
                                wire:model.lazy="content"
                                wire:ignore
                            ></textarea>

                            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
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
            &copy; 2023 Seth Sharp. All rights reserved.
        </p>

        <div class="flex space-x-2 justify-end">
            <a href="https://github.com/SethSharp">
                <img
                    class="size-9 inline-block transition ease-in-out delay-0 hover:-translate-y-1 duration-50"
                    src="/images/github.png"
                    alt="GitHub Image"
                >
            </a>
            <a href="https://www.linkedin.com/in/seth-sharp-213bb3211/">
                <img
                    class="size-7 transition ease-in-out delay-0 hover:-translate-y-1 duration-50"
                    src="/images/linkedIn.png"
                    alt="LinkedIn Image"
                >
            </a>
        </div>
    </div>
</footer>

