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
    <div class="sm:w-3/4 mx-auto">
        <div class="flex-wrap">
            <div class="text-5xl font-bold"> {{ $blog->title }}</div>

            <div class="mt-2 text-gray-400 font-medium text-lg">
                Published by {{ $blog->author->name  }} {{ $blog->created_at->diffForHumans() }}
            </div>

            <div class="flex gap-x-4 mt-2">
                @foreach($blog->tags as $tag)
                    <span
                        class="rounded-lg border-gray-300 border-2 bg-gray-100 text-md p-1 font-monot-"> {{ $tag->name }} </span>
                @endforeach
            </div>
        </div>

        <div class="mt-8 prose min-h-[400px]">
            {!! $content !!}
        </div>

        <div class="mt-8">
            <div class="mt-4">
                <livewire:blogs.comments.blog-comments :blog="$blog"/>
            </div>
        </div>
    </div>
@endsection
