@extends("layouts.main")

@section('title', 'Projects - ' . config('app.name'))

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
