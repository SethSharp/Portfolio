@section('title', 'Blogs - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Hey I am Seth Sharp, this is where you can find all my blogs!">
@endpush

@extends("layouts.main")

@section('partOne', 'My')
@section('partTwo', 'Blogs')

@section("content")
    <div class="text-center w-full">
        <x-body.enter-wrapper>
            <div class="!flex !text-left">
                <h2 class="text-xl">
                    Latest Series: <a href="{{ route('collections.show', $collection) }}"
                                      class="font-medium underline hover:text-gray-800">
                        {{ $collection->title }}
                    </a>
                </h2>
            </div>

            <div class="grid lg:grid-cols-2 gap-6 mt-6">
                @foreach($blogs as $blog)
                    <x-blogs.card :blog="$blog"/>
                @endforeach
            </div>
        </x-body.enter-wrapper>
    </div>
@stop
