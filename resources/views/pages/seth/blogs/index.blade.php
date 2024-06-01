@section('title', 'Blogs - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Hey I am Seth Sharp, this is where you can find all my blogs!">
@endpush

@push('links')
    <link rel="icon" href="{{ asset('/seth/favicon.ico') }}" type="image/x-icon">
@endpush

@extends("layouts.main")
@section('partOne', 'My')
@section('partTwo', 'Blogs')

@section("content")
    <div>
        <div class="text-6xl mt-16 text-white max-w-fit">
            <x-headings.typed>
                <h1 class="font-semibold font-mono track-wide">
                    My
                </h1>
                <h2 class="pl-4 font-light font-mono">
                    Blogs
                </h2>
            </x-headings.typed>
        </div>

        <x-body.enter-wrapper>
            <div class="grid xl:grid-cols-2 gap-6 mt-12">
                @foreach($blogs as $blog)
                    <x-blogs.seth.card :blog="$blog"/>
                @endforeach
            </div>
        </x-body.enter-wrapper>
    </div>
@stop
