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
            <div class="text-gray-600 font-medium text-2xl"> {{ $blog->author->name  }}</div>

            <div class="mt-2 text-gray-400 font-medium text-md">
                Published: {{ $blog->created_at->diffForHumans() }}
            </div>
        </div>

        <div class="mt-12 prose">
            {!! $blog->content !!}
        </div>
    </div>
@endsection
