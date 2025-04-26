{{-- resources/views/components/empty-state.blade.php --}}
@props(['title' => 'No Items Found', 'message' => 'There are no items to display at this time.', 'icon' => 'box'])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-12']) }}>
    @if($icon === 'box')
    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
    </svg>
    @elseif($icon === 'search')
    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
    @endif

    <p class="text-gray-500 text-lg font-medium">{{ $title }}</p>
    <p class="text-gray-400 mt-2">{{ $message }}</p>
    
    @if($slot->isNotEmpty())
        <div class="mt-6">
            {{ $slot }}
        </div>
    @endif
</div>