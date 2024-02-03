@section('partOne', 'Blog')
@section('partTwo', $blog->title)

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
    {!! $blog->content !!}
@endsection
