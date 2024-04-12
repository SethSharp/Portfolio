@extends("layouts.main")

@section('title', 'Projects - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Here I reflect on my most impressive projects which I am proud to say, 'I did that'!">

    @if (config('environment.current') !== \App\Http\EnvironmentEnum::SETH->value)
        <meta name="robots" content="noindex, nofollow"/>
    @endif
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

        <x-body.wrapper>
            <x-project.portfolio-package/>
        </x-body.wrapper>
    </div>
@stop
