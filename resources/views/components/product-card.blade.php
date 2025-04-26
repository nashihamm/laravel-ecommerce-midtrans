{{-- resources/views/components/product-card.blade.php --}}
@props(['product'])

<div 
    class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300"
    x-data="{ showQuickView: false }">
    <a href="{{ route('product.show', $product->id) }}" class="block relative group">
        <div class="relative overflow-hidden aspect-w-1 aspect-h-1">
            <img 
                src="{{ asset('uploads/' . $product->image) }}" 
                alt="{{ $product->name }}" 
                class="w-full h-48 object-cover object-center group-hover:scale-105 transition-transform duration-300"
                onerror="this.src='{{ asset('images/placeholder-image.jpg') }}'"
            >
            @if($product->stock <= 5 && $product->stock > 0)
                <span class="absolute top-2 left-2 bg-amber-500 text-white text-xs font-medium px-2 py-1 rounded">Low Stock</span>
            @elseif($product->stock == 0)
                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-medium px-2 py-1 rounded">Out of Stock</span>
            @endif
            
            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                <button 
                    type="button" 
                    @click.prevent="showQuickView = true" 
                    class="bg-white text-gray-800 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-100 transition-colors">
                    Quick View
                </button>
            </div>
        </div>
        
        <div class="p-4">
            <h2 class="text-lg font-medium text-gray-800 mb-1 line-clamp-2">{{ $product->name }}</h2>
            <p class="text-gray-500 text-sm mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
            <div class="flex items-center justify-between">
                <p class="text-lg font-bold text-indigo-700">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>
            </div>
        </div>
    </a>
    
    {{-- Quick View Modal --}}
    <div 
        x-show="showQuickView" 
        @click.away="showQuickView = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 z-50 overflow-y-auto" 
        style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black opacity-30" @click="showQuickView = false"></div>
            <div class="relative bg-white w-full max-w-md mx-auto rounded-lg shadow-xl">
                <button @click="showQuickView = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="p-6">
                    <div class="mb-4">
                        <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-md">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 150) }}</p>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-xl font-bold text-indigo-700">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500">Available: {{ $product->stock }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('product.show', $product->id) }}" class="flex-1 bg-indigo-600 text-white text-center py-2 rounded-md hover:bg-indigo-700 transition-colors">
                            View Details
                        </a>
                        @if($product->stock > 0)
                        <form action="{{ route('customer.cart.add', $product->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-md hover:bg-gray-900 transition-colors">
                                Add to Cart
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>