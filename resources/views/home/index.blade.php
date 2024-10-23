<x-customer-app>
    <div class="flex min-h-screen">
        <x-client.sidebar :categories="$categories" />

        <main class="flex-1 container mx-auto py-8 px-6 relative">
            <h1 class="text-4xl font-bold mb-6 text-center">Our Featured Products</h1>

            <div class="absolute top-4 right-4 text-sm">
                @auth
                    @if (Auth::user()->role === 'seller')
                        <a href="{{ route('seller.index') }}" class="text-gray-600 hover:underline">Dashboard</a>
                    @elseif (Auth::user()->role === 'customer')
                        <a href="{{ route('customer.dashboard') }}" class="text-gray-600 hover:underline">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:underline mr-4">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Register</a>
                @endauth
            </div>

            @if ($products->isEmpty())
                <p class="text-gray-500 text-center">Tak ada produk.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                            <a href="{{ route('product.show', $product->id) }}">
                                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md mb-4">
                                <h2 class="text-2xl font-semibold mb-2">{{ Str::words($product->name, 7, '...') }}</h2>
                                <p class="text-gray-900 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-gray-500">Stock: {{ $product->stock }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
</x-customer-app>
