<x-customer-app>
    <main class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-8">Shopping Cart</h1>

        @php
            $cartItems = collect($cartItems);
        @endphp

        @if($cartItems->isEmpty())
            <div class="bg-gray-100 p-6 rounded-lg text-center">
                <p class="text-lg text-gray-500">{{ $message ?? 'Keranjang Anda kosong' }}</p>
                <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-800 mt-4 inline-block">Mulai Belanja</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($cartItems as $cartItem)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img class="h-12 w-12 rounded-md object-cover" src="{{ $cartItem->product->image_url }}" alt="{{ $cartItem->product->name }}">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $cartItem->product->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $cartItem->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Rp {{ number_format($cartItem->product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Rp {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('customer.cart.remove', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Lanjutkan Belanja</a>
                <a href="{{ route('customer.checkout.index', ['productId' => $cartItems->first()->product->id]) }}" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">Checkout</a>
            </div>
        @endif
    </main>
</x-customer-app>
