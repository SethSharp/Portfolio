@php use App\Http\EnvironmentEnum; @endphp
@extends("layouts.main")

@section('title', 'Experiences - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Over my time in the industry I reflect on these experiences - to share to others about to go on their journey as developers or anyone that is curios.">

    @if (config('environment.current') !== EnvironmentEnum::SETH->value)
        <meta name="robots" content="noindex, nofollow"/>
    @endif
@endpush

@push('links')
    <link rel="icon" href="{{ asset('/seth/favicon.ico') }}" type="image/x-icon">
@endpush

@section('partOne', 'My')
@section('partTwo', 'Experiences')

@section("content")
    @php
        $timeline = [
            [
                'content' => 'Applied to',
                'target' => 'Coding Labs work placement',
                'description' => 'This was handled via a partnership with Griffith University in my final trimester of university.',
                'date' => 'Aug 22',
                'icon' => 'BuildingIcon',
                'iconBackground' => 'bg-gray-50',
           ],
           [
                'content' => '3 month placement',
                'target' => 'learning Laravel, Tailwind and Blade',
                'description' => 'First off we worked on a internal bootcamp course which took us over the basics of laravel, eloquent and blade. This had us working on a portfolio website which would be used in our work placement program at the Griffith, where we would reflect on our experience here. Toward the end fo the placement we worked on a new internal project which saw us getting thrown into Vue and learning on the spot. Vue would soon become my favourite to work with.',
                'date' => 'Sep 22',
                'icon' => 'PlacementIcon',
                'iconBackground' => 'bg-gray-50',
           ],
           [
                'content' => 'Offered',
                'target' => 'employment!',
                'description' => 'Employment was offered on a 2 day basis, which soon become 4 day employment throughout 2023.',
                'date' => 'Nov 22',
                'icon' => 'NewsPaperIcon',
                'iconBackground' => 'bg-gray-50',
           ],
           [
                'content' => 'Full time hours & owner',
                'target' => 'of a internal project during Q4 2023',
                'description' => 'This was a big point, where I was moved to 5 days of work and entrusted on a project as its owner for Q4.',
                'date' => 'Oct 23',
                'icon' => 'UserIcon',
                'iconBackground' => 'bg-gray-50',
           ],
           [
                'content' => 'Continued Development on',
                'target' => 'Internal Projects',
                'description' => '',
                'date' => 'Feb 24',
                'icon' => 'GroupUserIcon',
                'iconBackground' => 'bg-gray-50',
           ]
        ];
    @endphp

    <div>
        <div class="text-6xl mt-16 text-white max-w-fit">
            <x-headings.typed>
                <h1 class="font-semibold font-mono track-wide">
                    My
                </h1>
                <h2 class="pl-4 font-light font-mono">
                    Experiences
                </h2>
            </x-headings.typed>
        </div>

        <x-body.enter-wrapper>
            <div class="leading-loose mt-12">
                <h1 class="text-2xl font-medium text-gray-400"> Coding Labs (2022-Present) </h1>

                <p class="mt-3 text-gray-300">
                    Coding Labs is a Laravel agency based on the Gold Coast. I have been apart of this team for nearly 2
                    years
                    and have learn so much.
                </p>
            </div>
            <div class="flow-root mt-6 text-gray-300">
                <ul role="list" class="-mb-8">
                    @foreach($timeline as $event)
                        <li>
                            <div class="relative pb-8">
                                <span
                                    @if($loop->index !== count($timeline) - 1) class="absolute left-4 h-full w-0.5 bg-gray-200"
                                    aria-hidden="true" @endif>
                                </span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                            class="{{ $event['iconBackground'] }} w-8 h-8 p-0.5 rounded-md flex items-center justify-center ring-8 ring-white">
                                            @if($event['icon'] === 'BuildingIcon')
                                                <x-icons.building/>
                                            @elseif($event['icon'] === 'PlacementIcon')
                                                <x-icons.arrow-down/>
                                            @elseif($event['icon'] === 'NewsPaperIcon')
                                                <x-icons.newspaper/>
                                            @elseif($event['icon'] === 'UserIcon')
                                                <x-icons.user/>
                                            @elseif($event['icon'] === 'GroupUserIcon')
                                                <x-icons.group-user/>
                                            @endif
                                        </span>
                                    </div>

                                    <div class="md:flex min-w-0 flex-1 justify-between sm:space-x-4 pl-2 pt-1.5">
                                        <div>
                                            <p class="text-sm text-gray-200">
                                                {{ $event['content'] }}
                                                <span
                                                    class="font-medium text-primary-400">{{ $event['target'] }}
                                                </span>
                                            </p>
                                            @if(isset($event['description']))
                                                <p class="text-sm mt-4 text-gray-400">{{ $event['description'] }}</p>
                                            @endif
                                        </div>

                                        <div class="whitespace-nowrap text-right text-sm text-primary-600">
                                            {{ $event['date'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </x-body.enter-wrapper>
    </div>
@stop
