<div class="bg-white shadow-lg">
    <div class="container mx-auto p-4 flex justify-between items-center">
        <nav class="flex-grow mx-6">
            <ul class="flex space-x-8 text-white">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-600 transition-colors duration-200 text-lg">Home</a>
                </li>
                @if(auth()->check())
                    @if(auth()->user()->hasRole('seller'))
                        <li>
                            <a href="{{ route('seller.index') }}" class="text-gray-600 transition-colors duration-200 text-lg">Seller Dashboard</a>
                        </li>
                    @elseif(auth()->user()->hasRole('customer'))
                        <li>
                            <a href="{{ route('customer.customer.dashboard') }}" class="text-gray-600 transition-colors duration-200 text-lg">Customer Dashboard</a>
                        </li>
                    @endif
                @endif
            </ul>
        </nav>

        <!-- Profile and Cart Section -->
        <div class="flex items-center space-x-4">
            <x-customer-profile />

            <!-- Cart Icon with Badge -->
            <a href="{{ route('customer.cart.index') }}" class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 hover:text-gray-700 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-1.5 9H6L4.5 3zM1 1h2l1 2h16l1-2h2" />
                </svg>
                <span class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                    {{ auth()->user()->getOrCreateCart()->cartItems->count() ?? 0 }}
                </span>
            </a>
        </div>
    </div>
</div>
