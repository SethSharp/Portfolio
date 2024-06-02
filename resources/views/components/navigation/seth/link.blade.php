@props(['href', 'active' => false])

<a href="{{ $href }}"
   class="font-normal font-mono text-[#ACACAC] transition hover:text-gray-200 text-lg sm:text-2xl {{ request()->is($active) ? '!text-primary-400' : '' }}">
    {{ $slot }}
</a>
