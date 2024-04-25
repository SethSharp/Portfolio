<a href="{{ $href }}"
   class="font-serif tracking-wide border-transparent border-gray-500 hover:border-y text-sm my-auto sm:text-lg px-8 py-2 text-gray-600  {{ request()->is($active) ? 'border-y !border-gray-700' : '' }}">
    {{ $slot }}
</a>
