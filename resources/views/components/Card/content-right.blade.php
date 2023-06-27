@props(['title' => 'Temporary Title', 'content' => 'blank'])

<div class="w-3/4 my-10 bg-gray-50 leading-loose shadow-xl rounded-3xl flex">
    <div class="w-1/2">
        <img src="/images/car.jpg" class="h-full w-full object-cover rounded-l-3xl"/>
    </div>
    <div class="w-1/2 rounded-r-3xl">
        <div class="px-10 py-5 text-lg font-medium text-blue-800">
            {{ $title }}
        </div>
        <div class="px-12 pb-5 text-md">
            {{ $content }}
        </div>
    </div>
</div>
