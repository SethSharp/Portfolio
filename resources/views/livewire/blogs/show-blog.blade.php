@section('partOne', 'Blog')
@section('partTwo', $blog->title)

@section("content")
    {{ $blog->content }}
@endsection
