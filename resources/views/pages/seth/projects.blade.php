@php use App\Http\EnvironmentEnum; @endphp
@extends("layouts.main")

@section('title', 'Projects - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Here I reflect on my most impressive projects which I am proud to say, 'I did that'!">

    @if (config('environment.current') !== EnvironmentEnum::SETH->value)
        <meta name="robots" content="noindex, nofollow"/>
    @endif
@endpush

@section("content")
    <div>
        <div class="md:mt-14 max-w-fit">
            <x-headings.typed>
                <h1 class="font-semibold font-mono track-wide">
                    My
                </h1>
                <h2 class="pl-4 font-light font-mono">
                    Projects
                </h2>
            </x-headings.typed>
        </div>
        <div>
            <x-body.wrapper>
                <x-project.habit-tracker/>
            </x-body.wrapper>

            <x-body.wrapper>
                <x-project.framed/>
            </x-body.wrapper>

            <x-body.wrapper>
                <x-project.portfolio-package/>
            </x-body.wrapper>
        </div>
    </div>

@stop
