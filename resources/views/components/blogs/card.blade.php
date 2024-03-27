@props(['blog'])

<div class="rounded-xl shadow-md overflow-hidden sm:flex h-full md:space-y-4">
    <div class="sm:h-full sm:w-1/2 p-2 md:p-4">
        <img
            src="{{ $blog->cover_image }}"
            alt="{{ $blog->title . ' cover image' }}"
            class="rounded-lg overflow-hidden object-cover aspect-square object-left lg:size-full max-h-52 md:max-h-80 m-auto"
        />
    </div>

    <div class="sm:w-1/2 text-left px-4 h-full md:py-2">
        <div class="flex">
            <p class="text-xs text-gray-400 font-medium my-auto"> {{ $blog->author->name  }} {{ $blog->published_at->diffForHumans() }} </p>

            <div class="flex my-auto gap-0.5 ml-2 text-sm text-gray-400">
                <x-icons.heart class="!size-3 my-auto"/>
                <span> {{ $blog->likes->count() }}</span>
            </div>
        </div>

        <a href="{{ route('blogs.show', $blog)  }}" class="text-xl font-semibold"> {{ $blog->title }} </a>

        <div class="py-2 text-md text-secondary-400">
            {{ $blog?->meta_description }}
        </div>
    </div>
</div>
