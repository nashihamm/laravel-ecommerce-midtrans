{{-- resources/views/components/category-filter.blade.php --}}
@props(['categories', 'selectedCategory' => null])

<div x-data="{ open: false }" class="relative">
    <button 
        @click="open = !open"
        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >
        <span>{{ $selectedCategory ? $selectedCategory->name : 'All Categories' }}</span>
        <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>

    <div 
        x-show="open" 
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 w-full mt-2 origin-top-right bg-white rounded-md shadow-lg z-10"
        style="display: none;"
    >
        <div class="py-1 max-h-60 overflow-y-auto">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ !$selectedCategory ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}">
                All Categories
            </a>
            @foreach($categories as $category)
                <a 
                    href="{{ route('category.show', $category->slug) }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $selectedCategory && $selectedCategory->id === $category->id ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}"
                >
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>