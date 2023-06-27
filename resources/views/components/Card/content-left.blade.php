@props(['title' => 'Temporary Title', 'content' => 'blank', 'src' => 'blank.png'])

<div class="w-3/4 my-10 bg-gray-50 leading-loose shadow-xl rounded-3xl md:flex">
    <div class="w-full md:w-1/2 rounded-r-3xl h-fit">
        <div class="px-4 md:px-10 py-5 text-lg font-medium text-amber-400">
            {{ $title }}
        </div>
        <div class="px-6 md:px-12 pb-5 text-md">
            {{ $content }}
        </div>
    </div>
    <div class="w-full md:w-1/2 md:my-5 md:pl-6 md:p-2">
        <img src="/images/{{$src}}"
             class="h-80 w-full object-cover rounded-b-3xl md:rounded-b-none"/>
    </div>
</div>

