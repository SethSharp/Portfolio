@section('title', 'Collection - ' . config('app.name'))

@extends("layouts.beth-main")

@section('partOne', $collection->title)

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
