@props(['blog'])

<a class="rounded-xl bg-gray-50 h-52 cursor-pointer hover:bg-gray-200 transition"
   href="{{ route('blogs.show', $blog)  }}">
    {{ $blog->title }}
</a>
