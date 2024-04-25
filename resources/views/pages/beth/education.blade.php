@php use App\Http\EnvironmentEnum; @endphp
@extends("layouts.beth-main")

@section('title', 'Experiences - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Academic Curricula">

    @if (config('environment.current') !== EnvironmentEnum::BETH->value)
        <meta name="robots" content="noindex, nofollow"/>
    @endif
@endpush

@section("content")
    <x-body.enter-wrapper>
        <div>
            <x-headings.central>
                Academic Curricula
            </x-headings.central>

            <x-headings.h2>
                Griffith University
            </x-headings.h2>

            <x-headings.h2>
                Helensvale State High School (graduated 2021)
            </x-headings.h2>
        </div>
    </x-body.enter-wrapper>

    <x-body.wrapper>
        <x-headings.central>
            Other Academic Experiences / Achievements
        </x-headings.central>

        <div>
            Common Purposes Leadership for Good 2023 program

            Royal Australian Chemical Institute (RACI) National online careers fair and networking event

            Sciences PLUS (with Gayle Brent, Trimester 1 2023)

            Year 12 Prefect 2021 (Helensvale State High School)

            Relay for Life 2019 and 2021 (event organised and hosted by Cancer Council)

            Clean Up Australia Day 2019, 2020, 2021, 2022

            Northern Collegiate program
        </div>
    </x-body.wrapper>
@stop
