@extends("layouts.main")

@section('partOne', 'My')
@section('partTwo', 'Capabilities')

@section("content")
    <x-body.enter-wrapper>
        <div class="flex flex-wrap justify-center mt-5">
            <div class="w-3/4 my-10 py-8 bg-gray-50 leading-loose shadow-xl rounded-3xl md:flex">
                <div class="w-full rounded-r-3xl h-fit">
                    <div class="px-4 md:px-10 py-3 text-lg font-medium text-amber-400">
                        Bachelor of Computer Science
                    </div>
                    <div class="px-6 md:px-12 pb-5 text-md">
                        From 2020 to the beginning of 2024, I studied and successfully completed a <b> Bachelor of
                            Computer
                            Science </b>
                        degree with <b> Griffith University </b> on the Gold Coast. Graduating with a overall GPA of <b>
                            5.44 </b>, majoring in <b> Software Development </b>. This course took me over the
                        fundamentals
                        of
                        programming including
                        algorithms, data structures, AI and introductions to different software development life cycles.
                    </div>
                </div>
            </div>

            <div class="w-3/4 my-5 py-8 bg-gray-50 leading-loose shadow-xl rounded-3xl md:flex">
                <div class="w-full md:w-1/2 rounded-r-3xl h-fit">
                    <div class="px-4 md:px-10 py-5 text-lg font-medium text-blue-800">
                        Future Areas of Development
                    </div>

                    <div class="px-6 md:px-12 pb-5 leading-loose text-md md:text-md">
                        Although I currently focus on Web Development I also have passion and a drive
                        to commit myself to other areas, such as; <b> AI</b>, <b> Block Chain Technology </b>
                        and furthering skills in <b> Mobile Development</b>.
                    </div>
                </div>
                <div class="w-full md:w-1/2 rounded-r-3xl h-fit">
                    <div class="px-4 md:px-10 py-5 text-lg font-medium text-amber-400">
                        My Specialisation
                    </div>

                    <div class="px-6 md:px-12 pb-5 text-md">
                        During my time at <b> Coding Labs </b> I have developed a large skill set in <b> Web
                            Development </b>
                        as well as <b> Laravel Development</b>. These specific skillsets include the <b> VILT </b> (Vue,
                        Inertia,
                        Laravel and Tailwind) and
                        <b> TALL </b> (Tailwind, Alpine, Laravel, Livewire) stacks.
                    </div>
                </div>
            </div>
        </div>
    </x-body.enter-wrapper>
@stop
