@props(['title' => '', 'content' => '', 'src' => 'blank.png'])

<div class="w-3/4 mb-5 bg-gray-50 leading-loose shadow-xl rounded-3xl md:flex">
    <div class="w-full md:w-1/2 inline-flex items-center">
        <div class="inline-block w-full">
            <img src="/images/{{$src}}"
                 class="object-cover w-full h-80 rounded-t-3xl md:rounded-t-none lg:rounded-l-3xl"/>
        </div>
    </div>
    <div class="w-full md:w-1/2 rounded-r-3xl">
        <div class="px-4 md:px-10 py-5 text-lg font-medium text-blue-800">
            {{ $title }}
        </div>
        <div class="px-6 md:px-12 pb-5 leading-loose text-md">
            {{ $content }}
        </div>
    </div>
</div>
