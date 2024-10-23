<x-customer-app>
    <main class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">Daftar Pesanan dan Total Keseluruhan Order</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="md:col-span-3 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Daftar Pesanan</h2>
                
                @if($orders->isEmpty())
                    <p class="text-center text-gray-500">Belum ada pesanan.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Order ID</th>
                                    <th class="py-3 px-6 text-left">Nama Customer</th>
                                    <th class="py-3 px-6 text-left">Produk</th>
                                    <th class="py-3 px-6 text-left">Total Amount</th>
                                    <th class="py-3 px-6 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach($orders as $order)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6">{{ $order->id }}</td>
                                        <td class="py-3 px-6">{{ optional($order->user)->name }}</td> <!-- Displaying the customer name -->
                                        <td class="py-3 px-6">
                                            @foreach($order->orderItems as $item)
                                                <div>{{ optional($item->product)->name ?? 'Produk tidak tersedia' }} ({{ $item->quantity }})</div>
                                            @endforeach
                                        </td>
                                        <td class="py-3 px-6">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td class="py-3 px-6">
                                            <span class="px-2 py-1 text-xs font-semibold {{ $order->status == 'completed' ? 'bg-green-200 text-green-800' : ($order->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }} rounded-full">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            
            <div class="md:col-span-1 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Total Order</h2>
                
                @if($orders->isEmpty())
                    <p class="text-center text-gray-500">Silakan pilih pesanan untuk melihat total keseluruhan.</p>
                @else
                    @php
                        $totalAllOrders = $orders->sum('total_amount');
                        $shippingCost = 10000;
                        $grandTotal = $totalAllOrders + $shippingCost;
                    @endphp
                    <div>
                        <p class="text-gray-600 mb-2"><strong>Total Pesanan:</strong> Rp {{ number_format($totalAllOrders, 0, ',', '.') }}</p>
                        <p class="text-gray-600 mb-2"><strong>Biaya Pengiriman:</strong> Rp {{ number_format($shippingCost, 0, ',', '.') }}</p>
                        <p class="text-gray-800 mb-6 font-bold"><strong>Total Keseluruhan:</strong> Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
</x-customer-app>
