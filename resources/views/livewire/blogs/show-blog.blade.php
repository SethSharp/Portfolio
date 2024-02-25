@section('title', $blog->meta_title ?: '')

@push('meta')
    @if($blog->meta_description)
        <meta name="description" content="{{ $blog->meta_description }}">
    @endif

    @if($blog->meta_tags)
        {!! $blog->meta_tags !!}
    @endif
@endpush

<div class="sm:w-3/4 mx-auto">
    <div class="flex-wrap">
        <div class="text-2xl sm:text-3xl font-bold"> {{ $blog->title }}</div>

        <div class="mt-2 text-gray-400 font-medium text-md">
            @if($blog->published_at)
                Published
                by {{ $blog->author->name  }} {{ Carbon\Carbon::parse($blog->published_at)->diffForHumans() }}
            @else
                This blog is in a draft status
            @endif
        </div>

        <button type="button" wire:click="like"
                class="flex {{ $isLiked ? 'text-red-500 hover:text-red-300' : 'text-gray-400 hover:text-red-500' }}">
            <x-icons.heart/>
            <span class="text-gray-600 font-medium"> {{ $blogLikes }}</span>
        </button>
    </div>

    <div class="mt-8 prose min-h-[400px]">
        {!! $content !!}
    </div>

    <div class="flex gap-x-4 mt-2">
        @foreach($blog->tags as $tag)
            <span
                class="rounded-lg border-secondary-500 text-secondary-700 border-[1px] bg-gray-100 text-md p-2"> {{ $tag->name }} </span>
        @endforeach
    </div>

    <div class="mt-8">
        <livewire:blogs.comments.blog-comments :blog="$blog"/>
    </div>

    <x-modals.register/>
</div>
