@extends("layouts.main")

@section('partOne', 'The')
@section('partTwo', 'Sitemap!')

@section("content")
    <div>
        <ul>
            <li>
                <a class="text-lg hover:underline underline-offset-4 transition"
                   href="/">
                    About
                </a>
            </li>

            <li>
                <a class="text-lg hover:underline underline-offset-4 transition"
                   href="/experience">
                    Experiences
                </a>
            </li>

            <li>
                <a class="text-lg hover:underline underline-offset-4 transition"
                   href="/capabilities">
                    Capabilities
                </a>
            </li>

            <li>
                <a class="text-lg hover:underline underline-offset-4 transition"
                   href="/portfolio">
                    Portfolio
                </a>
            </li>

            <li>
                <a class="text-lg hover:underline underline-offset-4 transition"
                   href="/blogs">
                    Blogs
                </a>
            </li>
        </ul>


        <div class="w-full mt-6">
            <div class="text-2xl"> Blogs</div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-4">
                @foreach($blogs as $blog)
                    <a class="text-secondary-600 hover:text-secondary-700 hover:underline transition"
                       href="{{ route('blogs.show', $blog)  }}">
                        {{ $blog->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop
