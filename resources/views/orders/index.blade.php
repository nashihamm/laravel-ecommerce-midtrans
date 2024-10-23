<x-customer-app>
<main>


<!-- Daftar Pesanan -->
<div class="md:col-span-2">
    <h1 class="text-2xl font-semibold mb-6 text-center">Daftar Pesanan</h1>

    @if($orders->isEmpty())
        <p class="text-center text-gray-500">Belum ada pesanan.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-50 text-sm text-gray-600">
                        <th class="py-3 px-4 text-left">No</th>
                        <th class="py-3 px-4 text-left">Nama Produk</th>
                        <th class="py-3 px-4 text-left">Harga Per Item</th>
                        <th class="py-3 px-4 text-left">Jumlah</th>
                        <th class="py-3 px-4 text-left">Total Harga</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th>Riwayat Status</th>
                        <th class="py-3 px-4 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @foreach($orders as $index => $order)
                        @foreach($order->orderItems as $orderItem)
                            @php
                                $price = $orderItem->price;
                                $totalItemPrice = $price * $orderItem->quantity;
                            @endphp
                            <tr class="border-t border-gray-200 hover:bg-gray-100">
                                <td class="py-2 px-4">{{ $index + 1 }}</td>
                                <td class="py-2 px-4">{{ $orderItem->product->name }}</td>
                                <td class="py-2 px-4">Rp {{ number_format($price, 0, ',', '.') }}</td>
                                <td class="py-2 px-4">{{ $orderItem->quantity }}</td>
                                <td class="py-2 px-4">Rp {{ number_format($totalItemPrice, 0, ',', '.') }}</td>
                                <td class="py-2 px-4">{{ $order->status }}</td>
                                <td>
                                    <ul>
                                        @foreach ($order->status_history as $history)
                                            <li>{{ $history['status'] }} - {{ $history['changed_at'] }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="py-2 px-4">{{ $order->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
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
                
                {{-- <div class="flex justify-center">
                    <a href="{{ route('payment.process', ['order_id' => $orders->first()->id]) }}" class="w-full bg-blue-600 text-white py-3 px-6 rounded hover:bg-blue-700 transition text-center font-medium">Bayar</a>
                </div> --}}
            </div>
        @endif
    </div>

</main>

</x-customer-app>