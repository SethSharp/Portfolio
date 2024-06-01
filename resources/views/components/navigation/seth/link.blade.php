<a href="{{ $href }}"
   class="font-normal font-mono text-[#ACACAC] transition hover:text-gray-200 text-lg sm:text-2xl {{ request()->is($active) ? '!text-gray-200' : '' }}">
    {{ $slot }}
</a>
