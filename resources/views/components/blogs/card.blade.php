@props(['blog'])

<div class="rounded-xl shadow-md overflow-hidden hover:bg-gray-100 transition md:flex h-fit space-y-4">
    <div class="md:w-1/2 md:h-full p-4">
        <a href="{{ route('blogs.show', $blog)  }}">
            <img
                src="{{ $blog->cover_image }}"
                alt="{{ $blog->title . ' cover image' }}"
                class="rounded-lg overflow-hidden object-cover object-center md:size-full"
            />
        </a>
    </div>

    <div class="md:w-1/2 text-left p-4 h-full py-2">
        <a href="{{ route('blogs.show', $blog)  }}">
            <div class="flex">
                <p class="text-xs text-gray-400 font-medium my-auto"> {{ $blog->author->name  }} {{ Carbon\Carbon::parse($blog->published_at)->diffForHumans() }} </p>

                <div class="flex my-auto gap-0.5 ml-2 text-sm text-gray-400">
                    <x-icons.heart class="!size-3 my-auto"/>
                    <span> {{ $blog->likes->count() }}</span>
                </div>
            </div>

            <p class="text-xl font-semibold"> {{ $blog->title }} </p>

            <div class="py-2 text-md text-secondary-400">
                {{ $blog?->meta_description }}
            </div>
        </a>
    </div>
</div>
