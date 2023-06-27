@props(['title' => 'Temporary Title', 'content' => 'blank'])

<div
    class="absolute right-0 mr-10 md:w-1/2 bg-gray-50 leading-7 rounded-3xl shadow-xl border-black transition duration-200 ease-in-out hover:-translate-y-1 ">
    <div class="px-10 py-5 text-lg font-medium text-blue-800">
        {{ $title }}
    </div>
    <div class="px-12 pb-5 text-md">
        {{ $content }}
    </div>
</div>
