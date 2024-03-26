@props(['blog'])

<a class="rounded-xl shadow-md overflow-hidden cursor-pointer hover:bg-gray-100 transition md:flex h-full space-y-4"
   href="{{ route('blogs.show', $blog)  }}">
    <div class="md:w-1/2 md:h-full p-4">
        <img
            src="{{ $blog->cover_image }}"
            alt="{{ $blog->title . ' cover image' }}"
            class="rounded-lg overflow-hidden object-cover object-center md:size-full"
        />
    </div>

    <div class="md:w-1/2 text-left py-2">
        <div class="flex">
            <p class="text-xs text-gray-400 font-medium my-auto"> {{ $blog->author->name  }} {{ Carbon\Carbon::parse($blog->published_at)->diffForHumans() }} </p>

            <div class="flex my-auto gap-0.5 ml-2 text-sm text-gray-400">
                <x-icons.heart class="!size-3 my-auto"/>
                <span> {{ $blog->likes->count() }}</span>
            </div>
        </div>
        <div class="text-xl"> {{ $blog->title }} </div>

        <div class="mt-2 text-sm text-secondary-400 line-clamp-4">
            {{ $blog?->meta_description }}
        </div>
    </div>
</a>
