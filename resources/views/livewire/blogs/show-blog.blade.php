@section('title', $blog?->meta_title ? $blog->meta_title : $blog->title)

@push('meta')
    @if($blog->meta_description)
        <meta name="description" content="{{ $blog->meta_description }}">
    @endif

    @if($blog->meta_tags)
        <meta name="keywords" content="{{ $blog?->meta_tags ? $blog->meta_tags : '' }}">
    @endif

    @if (! $blog->is_published)
        <meta name="robots" content="noindex, nofollow"/>
    @endif
@endpush

<div class="md:w-4/5 lg:w-3/4 mx-auto">
    <div class="flex-wrap">
        @if($collection)
            <div class="text-gray-400 font-medium text-md">
                {{ $collection->title }}
            </div>
        @endif

        <h1 class="text-2xl sm:text-4xl font-extrabold"> {{ $blog->title }}</h1>

        <h6 class="text-gray-400 font-medium text-sm">
            @if($blog->published_at)
                {{ $blog->author->name  }} {{ $blog->published_at_for_humans }}
            @else
                This blog is in a draft status
            @endif
        </h6>
    </div>

    <div class="mt-8 prose min-h-[400px] leading-loose">
        {!! $content !!}
    </div>

    <div class="mt-12">
        <div class="sm:flex">
            <button type="button" wire:click="like"
                    class="flex my-auto mx-4 {{ $isLiked ? 'text-red-500 hover:text-red-300' : 'text-gray-400 hover:text-red-500' }}">
                <x-icons.heart/>
                <span class="text-gray-600 font-medium"> {{ $blogLikes }}</span>
            </button>

            <div class="gap-4 mt-4 flex py-5 sm:py-0 sm:flex sm:mt-0 overflow-x-auto">
                @foreach($blog->tags as $tag)
                    <span
                        class="rounded-lg text-gray-700 h-fit border-[1px] bg-gray-100 text-sm px-2 py-1 whitespace-nowrap">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>
        </div>

        <div class="mt-8">
            <livewire:blogs.comments.blog-comments :blog="$blog"/>
        </div>
    </div>

    <div class="mx-auto grid lg:grid-cols-2 gap-6">
        @if($prev)
            <div
                class="cursor-pointer rounded-lg border border-gray-300 transition hover:border-gray-500 hover:bg-gray-50 p-2">
                <a href="{{ route('blogs.show', $prev) }}">
                    <div class="flex">
                        <span class="text-primary-600">Previous blog </span>
                    </div>

                    <div class="text-gray-700">{{ $prev->title }}</div>
                </a>
            </div>
        @else
            <div></div>
        @endif

        @if($next)
            <div
                class="cursor-pointer rounded-lg border border-gray-300 transition hover:border-gray-500 hover:bg-gray-50 p-2">
                <a href="{{ route('blogs.show', $next) }}">
                    <div class="flex justify-end">
                        <span class="text-primary-600">Next blog </span>
                    </div>

                    <div class="flex justify-end text-right text-gray-700">{{ $blog->title }}</div>
                </a>
            </div>
        @endif
    </div>

    <div class="grid mb-6 mt-6">
        @if ($recentBlog)
            <h4 class="text-xl pb-4"> Recent Blog</h4>
            <x-blogs.card :blog="$recentBlog"/>
        @endif
    </div>

    <x-modals.register/>
</div>
