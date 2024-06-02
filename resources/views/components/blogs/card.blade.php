<a href="{{ route('blogs.show', $blog)  }}">
    <div class="sm:flex h-full gap-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
        <div class="sm:w-1/2 p-4">
            <img
                src="{{ $blog->cover }}"
                alt="{{ $blog->title . ' cover image' }}"
                class="rounded-lg h-full object-cover object-left max-h-64 mx-auto aspect-square"
            />
        </div>

        <div class="sm:w-1/2 p-2 text-left min-h-56">
            <div class="flex">
                <p class="text-xs text-gray-400 font-medium my-auto"> {{ $blog->author->name  }} {{ $blog->published_at_for_humans }} </p>

                <div class="flex my-auto gap-0.5 ml-2 text-sm text-gray-400">
                    <x-icons.heart class="!size-3 my-auto"/>
                    <span> {{ $blog->likes->count() }}</span>
                </div>
            </div>

            <h3 class="text-xl">
                {{ $blog->title }}
            </h3>

            <div class="line-clamp-6 mt-2 text-sm text-gray-400">
                {{ $blog?->meta_description }}
            </div>
        </div>
    </div>
</a>
