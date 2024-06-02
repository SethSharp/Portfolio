<div
    class="transition-all duration-500 ease-in opacity-0"
    x-data="{ inView: false }"
    x-intersect:enter="setTimeout(() => { inView = true }, 50)"
    :class="{' opacity-1 md:delay-500' : inView, 'translate-y-[2rem] opacity-0' : ! inView }"
>
    {{ $slot }}
</div>
