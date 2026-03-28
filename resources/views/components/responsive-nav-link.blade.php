@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-orange-400 text-start text-base font-medium text-orange-100 bg-orange-900/30 focus:outline-none focus:text-orange-200 focus:bg-orange-800/40 focus:border-orange-400 transition duration-150 ease-in-out shadow-md'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-200 hover:text-orange-300 hover:bg-gray-800/50 hover:border-orange-400 focus:outline-none focus:text-orange-300 focus:bg-gray-800/60 focus:border-orange-400 transition duration-150 ease-in-out shadow-sm';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>