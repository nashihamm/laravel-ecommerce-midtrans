<x-seller-app>
    <main>
        <div class="container mx-auto py-8">
            <h1 class="text-3xl font-bold mb-6">List Produk</h1>
            <div class="flex justify-between items-center mb-4">
                <div class="flex-grow">
                    <!-- Tempat untuk elemen pencarian dan filter (jika ada) -->
                </div>
                <a href="{{ route('seller.products.create') }}" class="btn btn-info transition">
                    Tambah Produk
                </a>
            </div>
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Harga</th>
                        <th class="border px-4 py-2">Gambar</th>
                        <th class="border px-4 py-2">Stok</th>
                        <th class="border px-4 py-2">Kategori</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    @foreach ($products as $product)
                    <tr onclick="openModal({{ json_encode($product) }})" class="cursor-pointer hover:bg-gray-100 transition">
                        <td class="border px-4 py-2">{{ $product->id }}</td>
                        <td class="border px-4 py-2">{{ $product->name }}</td>
                        <td class="border px-4 py-2">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td class="border px-4 py-2">
                            @if($product->image)
                                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-md">
                            @else
                                <span class="text-gray-500">No image</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $product->stock }}</td>
                        <td class="border px-4 py-2">{{ $product->category->name }}</td>
                        <td class="border px-4 py-2 flex space-x-2">
                            <a href="{{ route('seller.products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700">
                                <!-- Edit Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                            <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700" type="submit">
                                    <!-- Delete Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
            <!-- Modal -->
            <x-admin.modal-product />       
        </div>
    </main>

    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus produk ini?');
        }

        function openModal(product) {
            document.getElementById('modalProductName').innerText = product.name;
            document.getElementById('modalProductDescription').innerText = product.description || 'No description available';
            document.getElementById('modalProductPrice').innerText = 'Rp ' + product.price.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('modalProductStock').innerText = 'Stok: ' + product.stock;

            const modalImage = document.getElementById('modalProductImage');
            modalImage.src = product.image ? '/uploads/' + product.image : '';
            document.getElementById('modalEditLink').href = '{{ url("seller/products/") }}/' + product.id + '/edit';

            const modal = document.getElementById('productModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal(event) {
            document.getElementById('productModal').classList.add('hidden');
        }
    </script>
</x-seller-app>
