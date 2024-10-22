@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block px-4 py-2 text-white bg-gray-700 rounded-lg'
                : 'block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
