<x-customer-app>
    <main class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Your Profile</h1>

        <div class="bg-white p-4 rounded-lg shadow-md">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('customer.order.index') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">View Your Orders</a>
        </div>

        <!-- Daftar Order -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Your Orders</h2>
            @if($orders->isEmpty())
                <p>No orders found.</p>
            @else
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Order ID</th>
                            <th class="py-2 px-4 border-b">Total</th>
                            <th class="py-2 px-4 border-b">Status</th>
                            <th class="py-2 px-4 border-b">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $order->id }}</td>
                                <td class="py-2 px-4 border-b">Rp {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b">{{ ucfirst($order->status) }}</td>
                                <td class="py-2 px-4 border-b">{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Produkss</h2>
            @if($products->isEmpty())
                <p>No products found.</p>
            @else
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">ID produk</th>
                            <th class="py-2 px-4 border-b">nama Produk</th>
                            <th class="py-2 px-4 border-b">Harga</th>
                            <th class="py-2 px-4 border-b">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $product->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                                <td class="py-2 px-4 border-b">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b">{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </main>
</x-customer-app>
