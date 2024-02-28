<div
    class="transition-all duration-500 ease-in w-full"
    x-data="{ inView: false }"
    x-intersect.threshold.10="inView = true"
    :class="{'translate-y-0 opacity-1 md:delay-75' : inView, 'translate-y-[2rem] opacity-0' : ! inView }"
>
    {{ $slot }}
</div>
