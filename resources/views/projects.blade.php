@extends("layouts.main")

@section('partOne', 'My')
@section('partTwo', 'Projects')

@section("content")
    <div>
        <x-project.habit-tracker/>

        <x-project.framed/>
    </div>
@stop
