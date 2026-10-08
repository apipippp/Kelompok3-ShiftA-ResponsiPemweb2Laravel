@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-dark-green text-sm font-bold leading-5 text-dark-green focus:outline-none focus:border-dark-green transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-gray-600 hover:text-dark-green hover:border-sage focus:outline-none focus:text-dark-green focus:border-sage transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
