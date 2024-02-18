<button
    {{
       $attributes->merge([
           'class' => 'text-white bg-primary-500 rounded-lg hover:bg-primary-400 transition p-3',
       ])
    }}
>
    {{ $slot }}
</button>
