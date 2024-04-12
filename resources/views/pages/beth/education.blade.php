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
        This is my academic curricular
    </x-body.enter-wrapper>
@stop
