<a href="{{ route('blogs.show', $blog)  }}" class="block w-full">
    <div
        class="relative rounded-3xl h-64 hover:scale-105 transition duration-1000 overflow-hidden">
        <img
            src="{{ $blog->cover }}"
            alt="{{ $blog->title . ' cover image' }}"
            class="object-cover h-64 w-full rounded-none"
        />

        <div class="absolute inset-0 flex flex-col justify-end">
            <div class="bg-black/50">
                <div class="text-white text-md text-center p-2">
                    {{ $blog->title }}
                </div>
            </div>
        </div>
    </div>
</a>
