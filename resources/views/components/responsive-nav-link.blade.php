@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-dark-green text-start text-base font-medium text-dark-green bg-sage/10 focus:outline-none focus:text-dark-green focus:bg-sage/20 focus:border-dark-green transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-dark-green hover:bg-cream/40 hover:border-sage focus:outline-none focus:text-dark-green focus:bg-cream/40 focus:border-sage transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
