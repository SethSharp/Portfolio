@extends("layouts.main")

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
