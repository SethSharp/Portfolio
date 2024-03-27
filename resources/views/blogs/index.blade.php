@section('title', 'Blogs - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Hey I am Seth Sharp, this is where you can find all my blogs.">
@endpush

@extends("layouts.main")

@section('partOne', 'My')
@section('partTwo', 'Blogs')

@section("content")
    <div class="text-center w-full">
        <x-body.enter-wrapper>
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                @foreach($blogs as $blog)
                    <x-blogs.card :blog="$blog"/>
                @endforeach
            </div>
        </x-body.enter-wrapper>
    </div>
@stop
