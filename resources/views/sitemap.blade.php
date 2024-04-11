@extends("layouts.main")

@section('partOne', 'The')
@section('partTwo', 'Sitemap!')

@section("content")
    <div>
        <ul>
            @foreach(getCurrentEBEnvironmentConfig()['nav_links'] as $link)
                <li>
                    <a class="text-lg hover:underline underline-offset-4 transition"
                       href="{{ $link['href'] }}">
                        {{ $link['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="w-full mt-6">
            <div class="text-2xl"> Blogs</div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-4">
                @foreach($blogs as $blog)
                    <a class="text-gray-600 hover:text-gray-700 hover:underline transition"
                       href="{{ route('blogs.show', $blog)  }}">
                        {{ $blog->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop
