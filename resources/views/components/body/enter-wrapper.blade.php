<div
    class="flex flex-col gap-5 transition-all duration-500 ease-in"
    x-data="{ inView: false }"
    x-intersect:enter="inView = true"
    :class="{'translate-y-0 opacity-1 md:delay-75' : inView, 'translate-y-[2rem] opacity-0' : ! inView }"
>
    {{ $slot }}
</div>
