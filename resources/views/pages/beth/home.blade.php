@extends("layouts.beth-main")

@section('title', 'Home - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Hey I am Bethany">
@endpush

@section("content")
    <x-body.enter-wrapper>
        <div class="lg:flex gap-6">
            <div class="lg:w-1/2 leading-loose">
                <x-headings.h1>
                    Home
                </x-headings.h1>

                <div class="mt-4 tracking-wider">
                    <x-headings.h2>
                        Welcome!
                    </x-headings.h2>

                    <div class="text-gray-600 text-md">
                        <p>
                            My name is Bethany Frankis and I am an undergraduate student at Griffith University. I am
                            currently
                            studying a Bachelor of Science full-time, majoring in Chemistry and Biochemistry and
                            Molecular
                            Biology. I intend to complete my degree in 2025 and enter into a graduate chemist position.
                            Having
                            studied QCAA Chemistry and QCAA Biology in grade 11 and 12, I have developed a strong
                            connection
                            with these fields of knowledge and look forward to learning more about the physical world
                            around
                            us.
                        </p>

                        <br/>

                        <p>
                            I have always felt strongly about morality and doing the right thing in regard to people and
                            the
                            world we live in, and want to help create a sustainable future - of which sustainable
                            chemistry
                            is
                            imperative. As per the words of Barry Commoner; "The proper use of science is not to conquer
                            it,
                            but
                            to live in it." I intend to take this approach in my future endeavours: to understand the
                            world
                            at a
                            molecular level, and use what we know to sustain it to its fullest potential.
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2 p-6 flex">
                <img src="{{ asset('beth/bethany-profile-pic.webp') }}" class="my-auto"/>
            </div>
        </div>
    </x-body.enter-wrapper>

    <x-body.wrapper>
        <div class="w-3/4 mx-auto my-12">
            <div class="border bg-primary-50 p-8 text-center border-primary-800 text-primary-800">
                <div class="text-3xl italic mt-4">
                    "The proper use of science is not to conquer it but to live in it."
                </div>

                <div class="text-xl mt-8">
                    Barry Commoner (American cellular biologist, college professor and politician)
                </div>
            </div>
        </div>
    </x-body.wrapper>

    @if ($blogs->isNotEmpty())
        <div class="mt-6">
            <x-body.wrapper>
                <x-headings.h1>
                    My Most Recent Blogs
                </x-headings.h1>

                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:w-3/4 mx-auto gap-4 mt-6">
                    @foreach($blogs as $blog)
                        <x-arch :blog="$blog"/>
                    @endforeach
                </div>
            </x-body.wrapper>
        </div>
    @endif
@stop
