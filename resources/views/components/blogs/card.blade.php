@props(['blog'])

<div class="rounded-xl shadow-md overflow-hidden hover:bg-gray-100 transition md:flex h-fit space-y-4">
    <div class="md:h-full md:w-1/2 p-4">
        <img
            src="{{ $blog->cover_image }}"
            alt="{{ $blog->title . ' cover image' }}"
            class="rounded-lg overflow-hidden object-cover mx-auto object-center size-72"
        />
    </div>

    <div class="md:w-1/2 text-left p-4 h-full py-2">
        <div class="flex">
            <p class="text-xs text-gray-400 font-medium my-auto"> {{ $blog->author->name  }} {{ Carbon\Carbon::parse($blog->published_at)->diffForHumans() }} </p>

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
