@php use App\Http\EnvironmentEnum; @endphp
@extends("layouts.main")

@section('title', 'Contact')

@push('meta')
    <meta name="description"
          content="Contact Me">

    @if (config('environment.current') !== EnvironmentEnum::SETH->value)
        <meta name="robots" content="noindex, nofollow"/>
    @endif
@endpush

@section("content")
    <div>
        <div class="md:mt-16 text-white max-w-fit">
            <x-headings.typed>
                <h1 class="font-semibold font-mono track-wide">
                    Contact Me
                </h1>
            </x-headings.typed>
        </div>

        <x-body.wrapper>
            <div class="md:flex gap-6 mt-6">
                <div class="md:w-1/2">
                    <p class="text-gray-300 my-6">
                        Please feel free to contact me via the options below, or fill out the online form.
                        I look
                        forward to hearing from you!
                    </p>

                    <div class="flex gap-4">
                        @foreach(getCurrentEBEnvironmentConfig()['social_links'] as $link)
                            <a href="{{ $link['link'] }}" class="flex text-gray-400 gap-4 my-2 hover:text-gray-900">
                                <img
                                    class="size-8 transition ease-in-out delay-0 hover:-translate-y-1 duration-50"
                                    src="{{ '/images/' . $link['image'] }}"
                                    alt="{{ $link['alt'] }}"
                                >
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="md:w-1/2 mx-auto">
                    <div class="mt-6">
                        <livewire:contact-component/>
                    </div>
                </div>
            </div>
        </x-body.wrapper>
    </div>
@stop
