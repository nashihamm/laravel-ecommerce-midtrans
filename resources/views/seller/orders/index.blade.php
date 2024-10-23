<x-seller-app>
    <main>
        <!-- Daftar Pesanan -->
        <div class="md:col-span-2">
            <h1 class="text-2xl font-semibold mb-6 text-center">Daftar Pesanan</h1>

            @if($orders->isEmpty())
                <p>Belum ada pesanan.</p>
            @else
                <table class="w-full table-auto text-left">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Order ID</th>
                            <th class="px-4 py-2">Nama Customer</th>
                            <th class="px-4 py-2">Alamat</th>
                            <th class="px-4 py-2">Produk</th>
                            <th class="px-4 py-2">Total Amount</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="border px-4 py-2">{{ $order->id }}</td>
                                <td class="border px-4 py-2">{{ $order->customer->name }}</td> <!-- Nama customer -->
                                <td class="border px-4 py-2">{{ $order->customer->address }}</td> <!-- Alamat customer -->
                                <td class="border px-4 py-2">
                                    @foreach($order->orderItems as $item)
                                        {{ $item->product->name }} ({{ $item->quantity }})<br>
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="border px-4 py-2">{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Total Keseluruhan Order -->
        <div class="md:col-span-1">
            <h1 class="text-2xl font-semibold mb-6 text-center">Total Keseluruhan Order</h1>

            @if($orders->isEmpty())
                <p class="text-center text-gray-500">Silakan pilih pesanan untuk melihat total keseluruhan.</p>
            @else
                @php
                    $totalAllOrders = $orders->sum('total_amount');
                    $shippingCost = 10000; // Biaya pengiriman tetap
                    $grandTotal = $totalAllOrders + $shippingCost;
                @endphp
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h2 class="text-lg font-medium mb-4">Ringkasan Pembayaran</h2>
                    <p class="text-gray-600 mb-4"><strong>Total Pesanan:</strong> Rp {{ number_format($totalAllOrders, 0, ',', '.') }}</p>
                    <p class="text-gray-600 mb-4"><strong>Biaya Pengiriman:</strong> Rp {{ number_format($shippingCost, 0, ',', '.') }}</p>
                    <p class="text-gray-800 mb-6"><strong>Total Keseluruhan:</strong> Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
                </div>
            @endif
        </div>
    </main>
</x-seller-app>
