@extends("layouts.main")
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
                'description' => 'Employment was offered on a 2 day basis, which soon become 4 day employment throughout 2023',
                'date' => 'Nov 22',
                'icon' => 'NewsPaperIcon',
                'iconBackground' => 'bg-gray-50',
           ],
           [
                'content' => 'Full time hours & project owner',
                'target' => 'of a internal project during Q4 2023',
                'description' => 'This was a big point, where I was moved to 5 days of work and entrusted on a project as its owner for Q4.',
                'date' => 'Oct 23',
                'icon' => 'UserIcon',
                'iconBackground' => 'bg-gray-50',
           ]
        ];
    @endphp

    <x-nav-bar experience="text-black border-black" />

    <div class="w-full">

        <div class="mt-2 pt-1 md:mt-8 md:pt-4">
            <x-title title1="My" title2="Experiences"/>
        </div>

        <div class="md:flex mt-2 pt-1 mt-8 md:pt-24 w-3/4 m-auto">
            <div class="grid lg:grid-cols-2">
                <div class="leading-loose pr-4">
                    <h1 class="text-2xl font-medium"> Coding Labs</h1>

                    <p class="mt-3 text-gray-500">
                        Coding Labs is a Software Development studio based on the Gold Coast, working on bringing the
                        best products to market.
                        Time here has been very valuable to myself and has taught me so much about development I
                        wouldn't even think about.
                    </p>

                    <br>

                    <p class=" text-gray-500">
                        In terms of technology I have learned so many new frameworks to help build some awesome
                        products. Those frameworks being;
                        Laravel, Vue, Tailwind, Inertia, Alpine and Livewire. My Current focus here is working on a
                        project internally, as its owner
                        and bring it to commercialisation. This is a massive responsibility and have taken it with pride
                        and am dedicating a lot of time
                        and effort to ensure its success in its business market.
                    </p
                    >
                </div>
                <div class="flow-root mt-6 lg:mt-0">
                    <ul role="list" class="-mb-8">
                        @foreach($timeline as $event)
                            <li>
                                <div class="relative pb-8">
                                    <span
                                        @if($loop->index !== count($timeline) - 1) class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200"
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
                                                @endif
                                            </span>
                                        </div>

                                        <div class="flex min-w-0 flex-1 justify-between sm:space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    {{ $event['content'] }}
                                                    <span
                                                        class="font-medium text-gray-900">{{ $event['target'] }}</span>
                                                </p>
                                                @if(isset($event['description']))
                                                    <p class="text-sm mt-4 text-gray-500">{{ $event['description'] }}</p>
                                                @endif
                                            </div>

                                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                {{ $event['date'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
