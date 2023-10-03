@props(['title', 'src', 'caption'])

<div class="w-3/4 mb-12 bg-gray-50 leading-loose shadow-xl rounded-3xl md:flex">
    <div class="w-full md:w-1/2 rounded-r-3xl flex flex-col">
        <div class="px-4 md:px-10 py-5 text-lg font-medium text-amber-400">
            {{ $title }}
        </div>
        <div class="px-6 md:px-12 pb-5 text-md flex-grow">
            {{ $slot }}
        </div>
    </div>
    <div class="w-full md:w-1/2 inline-flex items-center">
        <div class="inline-block w-full relative">
            <img src="/images/{{$src}}"
                 class="object-cover w-full h-80 rounded-b-3xl md:rounded-b-none lg:rounded-r-3xl"/>
            <div class="absolute inset-0 flex flex-col justify-end content-end px-4 pb-4 z-20">
                <div class="text-white w-fit py-2 px-4 self-end bg-black bg-opacity-50 rounded-xl">
                    {{ $caption }}
                </div>
            </div>
        </div>
    </div>
</div>


