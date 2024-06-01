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
    <x-body.enter-wrapper>
        <div>
            <div class="md:flex gap-6 mt-10">
                <div class="md:w-1/2">
                    <x-headings.h1>
                        Contact Me!
                    </x-headings.h1>

                    <p class="text-gray-500 my-6">
                        Please feel free to contact me via the options below, or fill out the online form.
                        I look
                        forward to hearing from you!
                    </p>

                    <div>
                        @foreach(getCurrentEBEnvironmentConfig()['social_links'] as $link)
                            <a href="{{ $link['link'] }}" class="flex text-gray-600 gap-4 my-2 hover:text-gray-900">
                                <img
                                    class="size-8 transition ease-in-out delay-0 hover:-translate-y-1 duration-50"
                                    src="{{ '/images/' . $link['image'] }}"
                                    alt="{{ $link['alt'] }}"
                                >

                                <span class="my-auto">{{ $link['name'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="md:w-1/2 mx-auto">
                    <div class="mt-16">
                        <livewire:contact-component/>
                    </div>
                </div>
            </div>
        </div>
    </x-body.enter-wrapper>
@stop
