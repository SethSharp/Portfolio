<div class="w-full relative">
    <div class="flex justify-center relative z-10">
        <div
            class="border-[1px] border-primary-600 bg-primary-100 rounded-3xl p-2 text-base text-center md:text-xl text-primary-800">
            {{ $slot }}
        </div>
    </div>

    <div class="h-[1px] bg-primary-800 w-full absolute top-1/2 z-0"></div>
</div>
