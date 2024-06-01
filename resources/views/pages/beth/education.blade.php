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
        <div class="leading-loose text-gray-600">
            <x-headings.beth.central>
                Academic Curricula
            </x-headings.beth.central>

            <div>
                <x-headings.h2>
                    Griffith University
                </x-headings.h2>

                <div>

                </div>
            </div>

            <div class="my-8">
                <x-headings.h2>
                    Helensvale State High School (graduated 2021)
                </x-headings.h2>

                <div>
                    <p>
                        During my final 2 years of study i focused on subjects that...
                    </p>

                    <ul class="list-disc list-inside">
                        <li>Biology</li>
                        <li>Chemistry</li>
                        <li>General English</li>
                        <li>Mathematical Methods</li>
                        <li>Japanese</li>
                        <li>Legal Studies</li>
                    </ul>
                </div>
            </div>
        </div>
    </x-body.enter-wrapper>

    <x-body.wrapper>
        <x-headings.beth.central>
            Other Academic Experiences / Achievements
        </x-headings.beth.central>

        <div class="leading-loose text-gray-600">
            <p>
                Over the years...
            </p>
            <ul class="list-disc list-inside">
                <li>
                    Common Purposes Leadership for Good 2023 program
                </li>

                <li>
                    Royal Australian Chemical Institute (RACI) National online careers fair and networking event
                </li>

                <li>
                    Sciences PLUS (with Gayle Brent, Trimester 1 2023)
                </li>

                <li>
                    Year 12 Prefect 2021 (Helensvale State High School)
                </li>

                <li>
                    Relay for Life 2019 and 2021 (event organised and hosted by Cancer Council)
                </li>

                <li>
                    Clean Up Australia Day 2019, 2020, 2021, 2022
                </li>

                <li>
                    Northern Collegiate program
                </li>
            </ul>
        </div>
    </x-body.wrapper>
@stop
