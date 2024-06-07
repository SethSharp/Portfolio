@section('title', 'Blogs - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Hey I am Seth Sharp, this is where you can find all my blogs!">
@endpush

@extends("layouts.main")
@section('partOne', 'My')
@section('partTwo', 'Blogs')

@section("content")
    <div>
        <div class="md:mt-16 text-white max-w-fit">
            <x-headings.typed>
                <h1 class="font-semibold font-mono track-wide">
                    My
                </h1>
                <h2 class="pl-4 font-light font-mono">
                    Blogs
                </h2>
            </x-headings.typed>
        </div>

        <x-body.wrapper>
            <div class="grid xl:grid-cols-2 gap-6 mt-12 bg-white shadow-lg shadow-primary-500 rounded-lg p-2 md:p-6">
                @foreach($blogs as $blog)
                    <x-blogs.card :blog="$blog"/>
                @endforeach
            </div>
        </x-body.wrapper>
    </div>
@stop
