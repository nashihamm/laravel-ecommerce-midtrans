@php
    $baseClasses = 'px-4 py-2 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-opacity-75 ';
    
    // Define variant styles
    $variantClasses = [
        'primary' => 'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-400',
        'secondary' => 'bg-gray-500 text-white hover:bg-gray-600 focus:ring-gray-400',
        'danger' => 'bg-red-500 text-white hover:bg-red-600 focus:ring-red-400',
        'success' => 'bg-green-500 text-white hover:bg-green-600 focus:ring-green-400',
        'warning' => 'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-400',
    ][$variant] ?? $variantClasses['primary'];
@endphp

<button 
    type="{{ $type }}" 
    class="{{ $baseClasses }} {{ $variantClasses }} {{ $class }}">
    {{ $text }}
</button>
