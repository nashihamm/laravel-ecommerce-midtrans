{{-- resources/views/home/index.blade.php --}}
<x-customer-app>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar Component -->
        <div class="hidden md:block w-64 flex-shrink-0">
            <x-client.sidebar :categories="$categories" />
        </div>

        <!-- Main Content Area -->
        <main class="flex-1 container mx-auto py-8 px-4 sm:px-6 lg:px-8 relative" 
              x-data="{ 
                  showFilters: false,
                  searchQuery: '',
                  sortBy: 'latest',
                  priceRange: { min: 0, max: 5000000 }
              }">
            <!-- Mobile Menu Toggle -->
            <div class="md:hidden flex justify-between items-center mb-6">
                <button 
                    @click="showFilters = !showFilters" 
                    class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                    Filters
                </button>
                <x-category-filter :categories="$categories" :selectedCategory="$selectedCategory ?? null" />
            </div>

            <!-- Mobile Filters Sidebar -->
            <div 
                x-show="showFilters" 
                @click.away="showFilters = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-full"
                class="fixed inset-0 z-40 md:hidden"
                style="display: none;"
            >
                <div class="fixed inset-0 bg-black bg-opacity-25" @click="showFilters = false"></div>
                <div class="relative flex flex-col w-80 max-w-xs h-full bg-white overflow-y-auto p-6 shadow-xl">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                        <button @click="showFilters = false" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Categories -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-sm font-medium text-gray-900 mb-4">Categories</h3>
                        <div class="space-y-2">
                            <a href="{{ route('home') }}" class="block text-sm text-gray-700 hover:text-indigo-600 {{ !isset($selectedCategory) ? 'font-medium text-indigo-600' : '' }}">
                                All Categories
                            </a>
                            @foreach($categories as $category)
                                <a 
                                    href="{{ route('category.show', $category->slug) }}" 
                                    class="block text-sm text-gray-700 hover:text-indigo-600 {{ isset($selectedCategory) && $selectedCategory->id === $category->id ? 'font-medium text-indigo-600' : '' }}"
                                >
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <header class="mb-8 relative">
                <div class="text-center">
                    <h1 class="text-3xl font-semibold text-gray-800 mb-2">
                        @if(isset($selectedCategory))
                            {{ $selectedCategory->name }}
                        @else
                            Premium Collection
                        @endif
                    </h1>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        @if(isset($selectedCategory))
                            Browse our selection of high-quality {{ $selectedCategory->name }} products
                        @else
                            Discover our handpicked selection of high-quality products
                        @endif
                    </p>
                </div>
                
                <!-- Authentication Navigation -->
                <div class="absolute top-0 right-0 flex items-center space-x-4">
                    @auth
                        <!-- Shopping Cart -->
                        <a href="{{ route('customer.cart.index') }}" class="text-gray-700 hover:text-gray-900 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            @if(session()->has('cart') && count(session('cart')) > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                        
                        <!-- User Dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                                <span class="mr-2">{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
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
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10"
                                style="display: none;"
                            >
                                @if (Auth::user()->role === 'seller')
                                    <a href="{{ route('customer.seller.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Seller Dashboard</a>
                                @elseif (Auth::user()->role === 'customer')
                                    <a href="{{ route('customer.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Account</a>
                                @endif
                                <a href="{{ route('customer.order.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Orders</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign Out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Sign In</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors">Create Account</a>
                    @endauth
                </div>
            </header>
            
            <!-- Search and Sort Controls -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 space-y-4 sm:space-y-0">
                <div class="relative w-full sm:w-64">
                    <input 
                        type="text" 
                        placeholder="Search products..." 
                        x-model="searchQuery"
                        class="w-full px-4 py-2 pr-10 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Sort by:</span>
                    <select 
                        x-model="sortBy"
                        class="text-sm border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                        <option value="latest">Latest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="popularity">Popularity</option>
                    </select>
                </div>
            </div>

            <!-- Product Listing Section -->
            @if ($products->isEmpty())
                <x-empty-state 
                    title="No Products Found" 
                    message="We couldn't find any products matching your criteria. Please check back later or try different filters."
                    icon="search"
                >
                {{-- continue --}}
                </x-empty-state>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
                {{-- <div class="mt-8">
                    {{ $products->links() }}
                </div> --}}
            @endif
        </main>
    </div>
</x-customer-app>