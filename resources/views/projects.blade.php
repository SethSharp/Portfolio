@extends("layouts.main")

@section('title', 'Projects - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Hey I am Seth Sharp, a Junior Software developer at Coding Labs on the Gold Coast. I love to build ambitious projects and love the art of programming.">
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
