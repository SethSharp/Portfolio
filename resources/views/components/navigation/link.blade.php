<a href="{{ $href }}"
   class="font-medium hover:underline text-lg sm:text-2xl underline-offset-4 {{ request()->is($active) ? 'underline' : '' }}">
    {{ $slot }}
</a>
