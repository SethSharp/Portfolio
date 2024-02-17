@extends("layouts.main")

@section('partOne', 'My')
@section('partTwo', 'Blogs')

@section("content")
    <div class="text-center w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-4">
            @foreach($blogs as $blog)
                <x-blogs.card :blog="$blog"/>
            @endforeach
        </div>
    </div>
@stop
