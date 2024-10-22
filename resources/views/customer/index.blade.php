<x-customer-app>
    <main>
        <div class="container mx-auto">            
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold">Sugeng rawuh, {{ $user->name }}!</h2>
                <p class="mt-2">Ini adalah dashboard.</p>
                
                <div class="mt-4">
                    <a href="{{ route('customer.cart.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Keranjang
                    </a>
                    <a href="{{ route('customer.order.index') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-4">
                        Pesanan
                    </a>
                </div>
                
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Produk Tersedia</h3>
                    {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($products as $product)
                            <div class="border rounded-lg p-4">
                                <h4 class="font-bold">{{ $product->name }}</h4>
                                <p>Harga: Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                                <p>Stok: {{ $product->stock }}</p>
                                <a href="{{ route('customer.products.show', $product->id) }}" class="text-blue-500 hover:underline">Lihat Detail</a>
                            </div>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </div>
    </main>
</x-customer-app>
