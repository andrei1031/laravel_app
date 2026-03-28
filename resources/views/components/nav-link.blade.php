@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-orange-400 text-sm font-medium leading-5 text-orange-100 focus:outline-none focus:border-orange-400 transition duration-150 ease-in-out shadow-lg'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-200 hover:text-orange-300 hover:border-orange-400 focus:outline-none focus:text-orange-300 focus:border-orange-400 transition duration-150 ease-in-out shadow-md hover:shadow-lg backdrop-blur-sm';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>