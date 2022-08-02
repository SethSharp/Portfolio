

<div class="bg-gray-50 custom2:flex flex-row w-full">
    <div class="justify-center px-20 md:px-32 my-10 p-6">
        <div class="custom2:flex custom2:flex-col">
            <div>
                <h1 class="text-3xl font-bold text-blue-800 inline-block"> {{$title}} </h1>
                <p class="text-bold pt-4 sm:p-6 font-medium">
                    {{$desc}}
                </p>
            </div>
{{--            Holds the tech and images in same row of grid
                at the larger view
--}}
            <div class="custom3:flex">
                <div class="p-6 sm:pl-20">
                    <h1> Technology: </h1>
                    <ul class="p-6 list-disc">
                        @foreach($technology as $value)
                            <li>{{ $value }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="custom2:grow">
                    <div class="items-center flex flex-wrap sm:flex justify-center">
                        <x-image-card image="{{$img_1}}" ></x-image-card>
                        <x-image-card image="{{$img_2}}" ></x-image-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
