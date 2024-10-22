<x-customer-app>
    <main class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

        @if($cartItems->isEmpty())
            <p class="text-gray-500">{{ $message ?? 'Your cart is empty.' }}</p>
        @else
            <table class="w-full text-left table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                        <tr>
                            <td class="border px-4 py-2">
                                {{ $cartItem->product->name }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $cartItem->quantity }}
                            </td>
                            <td class="border px-4 py-2">
                                Rp {{ number_format($cartItem->product->price, 0, ',', '.') }}
                            </td>
                            <td class="border px-4 py-2">
                                Rp {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}
                            </td>
                            <td class="border px-4 py-2">
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

            <div class="mt-6">
                <a href="{{ route('customer.checkout.index', ['productId' => $cartItems->first()->product->id]) }}" class="btn btn-success">Proceed to Checkout</a>
            </div>
        @endif
    </main>
</x-customer-app>
