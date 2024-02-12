@section('title', $blog->meta_title ?: '')

@push('meta')
    @if($blog->meta_description)
        <meta name="description" content="{{ $blog->meta_description }}">
    @endif

    @if($blog->meta_tags)
        {!! $blog->meta_tags !!}
    @endif
@endpush

@section("content")
    <div class="w-3/4 mx-auto">
        <div class="flex-wrap">
            <div class="text-5xl font-bold"> {{ $blog->title }}</div>

            <div class="mt-2 text-gray-400 font-medium text-lg">
                Published by {{ $blog->author->name  }} {{ $blog->created_at->diffForHumans() }}
            </div>
        </div>

        <div class="mt-8 prose min-h-[400px]">
            {!! $content !!}
        </div>

        <div class="mt-8">
            <span class="text-gray-400 text-xl"> Comments</span>
            <livewire:blogs.comments.blog-comments :blog="$blog"/>
        </div>
    </div>
@endsection
