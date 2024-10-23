<x-customer-app>
    <main class="container mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6 text-center">Checkout</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h2>
            <ul class="mb-4">
                @foreach($cartItems as $item)
                    <li class="mb-2">
                        {{ $item->product->name }} - {{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}
                    </li>
                @endforeach
            </ul>
            <p class="text-lg">Total: Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>

            {{-- Menggunakan $order_id yang dikirim dari controller --}}
            <a href="{{ route('customer.payment.process', ['order_id' => $order_id]) }}"
            class="btn btn-success rounded mt-4 inline-block">Bayar</a>
        </div>
    </main>
</x-customer-app>




{{-- <x-customer-app>
    <main class="container mx-auto py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-center">Checkout</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-100 p-6 rounded-lg shadow">
                    <h2 class="text-2xl font-bold mb-4">Produk yang Dibeli</h2>
                    <div id="daftar-produk">
                        @foreach ($cartItems as $cartItem)
                            <div class="flex justify-between items-center mb-6 p-4 border-b border-gray-300">
                                <div>
                                    <h3 class="text-xl font-semibold">{{ $cartItem->product->name }}</h3>
                                    <p class="text-gray-700">Harga: Rp {{ number_format($cartItem->product->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="flex items-center">
                                    <button onclick="kurangiKuantitas({{ $cartItem->id }})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">-</button>
                                    <input id="kuantitas-{{ $cartItem->id }}" type="number" value="{{ $cartItem->quantity }}" min="1" class="w-12 text-center mx-2 border rounded" readonly>
                                    <button onclick="tambahKuantitas({{ $cartItem->id }})" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="font-bold mt-6 text-lg">Total Harga: <span id="total-harga" class="text-green-600">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span></p>
                </div>

                <!-- Ringkasan belanjaaan -->
                <div class="border-2 border-gray-600 rounded-lg p-6 shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Ringkasan Belanja</h2>
                    <div class="mb-6">
                        <p class="text-lg text-gray-700">Total Produk: <span id="total-kuantitas" class="font-bold">{{ $totalQuantity }}</span></p>
                        <p class="text-lg text-gray-700">Total Pembayaran: <span id="total-ringkasan" class="font-bold text-green-600">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span></p>
                    </div>

                    <!-- proses pesan order -->
                    <form action="{{ route('customer.order.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                            <input type="text" name="address" id="alamat" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                    
                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium text-gray-700">Pesan (Opsional)</label>
                            <textarea name="message" id="message" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                    
                        <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded hover:bg-blue-600 font-semibold">Buat Pesanan</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </main>

    <script>
        const produk = @json($cartItems->mapWithKeys(function($cartItem) {
            return [$cartItem->id => ['harga' => $cartItem->product->price, 'kuantitas' => $cartItem->quantity]];
        }));

        function updateTotal() {
            let totalHarga = 0;
            let totalKuantitas = 0;

            Object.keys(produk).forEach(cartItemId => {
                const kuantitas = parseInt(document.getElementById(`kuantitas-${cartItemId}`).value);
                const harga = produk[cartItemId].harga;

                totalHarga += harga * kuantitas;
                totalKuantitas += kuantitas;
            });

            document.getElementById('total-harga').innerText = 'Rp ' + totalHarga.toLocaleString('id-ID');
            document.getElementById('total-ringkasan').innerText = 'Rp ' + totalHarga.toLocaleString('id-ID');
            document.getElementById('total-kuantitas').innerText = totalKuantitas;
        }

        function tambahKuantitas(cartItemId) {
            const kuantitasInput = document.getElementById(`kuantitas-${cartItemId}`);
            const kuantitasBaru = parseInt(kuantitasInput.value) + 1;

            kuantitasInput.value = kuantitasBaru;
            produk[cartItemId].kuantitas = kuantitasBaru;

            updateTotal();
            updateCartItem(cartItemId, kuantitasBaru);
        }

        function kurangiKuantitas(cartItemId) {
            const kuantitasInput = document.getElementById(`kuantitas-${cartItemId}`);
            const kuantitasSekarang = parseInt(kuantitasInput.value);

            if (kuantitasSekarang > 1) {
                const kuantitasBaru = kuantitasSekarang - 1;
                kuantitasInput.value = kuantitasBaru;
                produk[cartItemId].kuantitas = kuantitasBaru;

                updateTotal();
                updateCartItem(cartItemId, kuantitasBaru);
            }
        }

        function updateCartItem(cartItemId, newQuantity) {
            fetch(`/cart/update/${cartItemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    quantity: newQuantity,
                }),
            }).then(response => {
                if (!response.ok) {
                    console.error('Gagal mengupdate kuantitas');
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</x-customer-app> --}}
