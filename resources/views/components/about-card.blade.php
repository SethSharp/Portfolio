@props(['title' => 'Default Title'])
@props(['content' => 'Default Content'])

<div class="sm:w-[19rem] h-[20rem]
            sm:m-10 mt-6
{{--            flex-cus--}}
            p-10 pt-4
            rounded-3xl
            shadow-black shadow-2xl
            transition ease-in-out delay-200
            hover:-translate-y-1 hover:scale-110 hover:bg-gray-100 duration-500
            ">
    <div class="">
        <h1 class="text-2xl font-bold text-black"> {{$title}} </h1>
        <p class=""> {{$content}} </p>
    </div>
</div>
