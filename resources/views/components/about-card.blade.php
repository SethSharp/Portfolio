@props(['title' => 'Default Title'])
@props(['content' => 'Default Content'])
@props(['content_2' => 'Default Content'])
@props(['p_float_dir' => 'float-left ml-3'])
@props(['img_float_dir' => 'float-left'])
@props(['img_src' => 'b'])

<div class="w-3/4 my-4">
    <div class="w-full bg-red-100">
        <div class="z-20 border border-black rounded-3xl mt-0.5 {{$p_float_dir}} bg-white relative">
            <h1 class="p-4 font-medium text-2xl"> {{$title}} </h1>
        </div>
    </div>
    <div class="z-10 relative bg-gray-200 border border-black rounded-3xl mt-8 w-full p-10">
        @if($content_2 == 'Default Content')
            </br>
            <div class="flex flex-wrap">
                @if($img_src != 'b')
                    <p class="sm:w-3/4"> {{$content}} </p>
                    <img class="object-contain h-full w-40 pl-4 {{$img_float_dir}} rounded-lg"
                        src="/images/{{$img_src}}"
                        alt="about-picture">
                @else
                    <p class=""> {{$content}} </p>
                @endif
            </div>

        @else
            <p> {{$content}} </p>
            <br>
            <div class="flex flex-wrap">
                <p class="sm:w-3/4"> {{$content_2}} </p>
                @if($img_src != 'b')
                    <img class="object-contain h-full pl-4 w-40 {{$img_float_dir}} rounded-lg"
                        src="/images/{{$img_src}}"
                        alt="about-picture">
                @endif
            </div>

        @endif
    </div>
</div>
