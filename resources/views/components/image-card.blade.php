@props(['image' => 'blank'])

<div class="w-[12rem] h-[12rem] sm:w-[13rem] sm:h-[13rem]
            my-4 p-8
            rounded-3xl
            shadow-black shadow-md
            text-center">
    <div class="transition ease-in-out delay-300
                hover:-translate-y-1 hover:scale-[1.75] duration-700">
        <img class=""
             src="/images/{{$image}}.png"
             alt="about-picture">
    </div>
</div>
