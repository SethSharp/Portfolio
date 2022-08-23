<div class="w-3/4 my-4">
    <div class="w-full bg-red-100">
        <div class="z-20 border border-black rounded-3xl mt-0.5 {{$pFloatDir}} bg-white relative">
            <h1 class="p-4 font-medium text-2xl"> {{$title}} </h1>
        </div>
    </div>
    <div class="z-10 relative bg-gray-200 border border-black rounded-3xl mt-8 w-full p-10">
        @if($content2Passed())
            </br>
            <div class="flex flex-wrap">
                @if($imgPassed())
                    <p class="sm:w-3/4"> {{$content1}} </p>
                    <img class="object-contain h-full w-40 pl-4 {{$imgFloatDir}} rounded-lg"
                        src="/images/{{$imgSrc}}"
                        alt="about-picture">
                @else
                    <p class=""> {{$content1}} </p>
                @endif
            </div>

        @else
            <p> {{$content1}} </p>
            <br>
            <div class="flex flex-wrap">
                <p class="sm:w-3/4"> {{$content2}} </p>
                @if($imgPassed())
                    <img class="object-contain h-full pl-4 w-40 {{$imgFloatDir}} rounded-lg"
                        src="/images/{{$imgSrc}}"
                        alt="about-picture">
                @endif
            </div>

        @endif
    </div>
</div>
