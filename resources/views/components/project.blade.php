@props(['title' => 'Project Title'])
@props(['desc' => 'Project Desc...'])
@props(['dur' => 'Project Duration'])
@props(['link' => 'Project link'])
@props(['tech' => 'No Technologies'])
@props(['img_1' => 'blank'])
@props(['img_2' => 'blank'])
@props(['img_3' => 'blank'])

<div class="bg-gray-50 w-full p-20
            custom2:flex flex-row">

    <div class="w-full lg:w-1/3 bg-red-100
                custom2:flex custom2:flex-col">
        <h1 class="text-3xl font-bold text-blue-800 inline-block"> {{$title}} </h1>
        <p class="text-bold bg-gray-100"> {{$desc}} </p>
        <h1> Technology: </h1>
    </div>
    <div class="w-full lg:w-2/3 bg-yellow-200 custom2:grow">
        <div class="items-center flex flex-wrap sm:flex justify-center">
            <x-image-card></x-image-card>
            <x-image-card></x-image-card>
            <x-image-card></x-image-card>
            <x-image-card></x-image-card>
        </div>

    </div>
</div>
