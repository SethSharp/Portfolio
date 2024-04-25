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
            <x-headings.h1>
                Contact Me!
            </x-headings.h1>

            <p class="text-gray-500 my-6">
                Please feel free to contact me via the options below, or fill out the online form to the right. I look
                forward to hearing from you!
            </p>

            <livewire:contact-component/>
        </div>
    </x-body.enter-wrapper>
@stop
