@php use App\Http\EnvironmentEnum; @endphp
@extends("layouts.main")

@push('links')
    @if (config('environment.current') === EnvironmentEnum::SETH->value)
        <link rel="icon" href="{{ asset('/seth/favicon.ico') }}" type="image/x-icon">
    @else
        <link rel="icon" href="{{ asset('/beth/favicon.ico') }}" type="image/x-icon">
    @endif
@endpush

@section("content")
    <div>
        <div class="flex">
            <div class="animate-pulse duration-900 text-primary-500 text-8xl font-medium">
                404
            </div>
        </div>

        <div class="text-gray-500 text-2xl font-medium">
            Seems this page is out of order!
        </div>

        <div class="mt-6">
            <a href="/"
               class="flex text-black text-xl font-medium transition hover:-translate-y-1">
                Head Home
                <div class="my-auto">
                    <x-icons.chevron-right/>
                </div>
            </a>
        </div>
    </div>
@endsection
