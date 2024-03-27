@extends("layouts.main")

@section('title', 'Projects - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Here I reflect on my most impressive projects which I am proud to say, 'I did that'!">
@endpush

@section('partOne', 'My')
@section('partTwo', 'Projects')

@section("content")
    <div>
        <x-body.enter-wrapper>
            <x-project.habit-tracker/>
        </x-body.enter-wrapper>

        <x-body.wrapper>
            <x-project.framed/>
        </x-body.wrapper>
    </div>
@stop
