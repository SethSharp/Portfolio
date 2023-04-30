@props(['image' => 'blank'])

<div class="w-[14rem] h-[14rem]
            transition ease-in-out delay-300
            hover:-translate-y-1 hover:scale-[1.75] duration-700">
    <img class="object-contain h-full w-96 p-4"
         src="/images/{{$image}}"
         alt="about-picture"/>
</div>
