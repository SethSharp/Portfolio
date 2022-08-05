@props(['title' => 'Default Title'])
@props(['content' => 'Default Content'])

<div class="h-auto w-auto
            sm:m-10
            p-10 pt-4
            rounded-3xl
            shadow-black shadow-md
            transition ease-in-out delay-200
            hover:-translate-y-1 hover:scale-110 hover:bg-gray-100 duration-500">
    <div>
        <h1 class="text-2xl font-bold text-black"> {{$title}} </h1>
        <p class="w-60"> {{$content}} </p>
    </div>
</div>
