@props(['caption' => ''])
@props(['image' => 'blank'])

<div class="w-[12rem] h-[12rem] sm:w-[13rem] sm:h-[13rem]
            m-4 p-8
{{--            m-10 p-8--}}
{{--            flex-cus--}}
            rounded-3xl
            shadow-black
            shadow-2xl
            text-center">
    <div class="transition ease-in-out delay-300
                hover:-translate-y-1 hover:scale-[1.75] duration-700">
        <img class=""
             src="/images/{{$image}}.png"
             alt="about-picture">
    </div>

    <caption> {{$caption}} </caption>
</div>
