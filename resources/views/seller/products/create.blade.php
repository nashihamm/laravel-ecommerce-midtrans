<x-seller-app>
    <main class="max-w-4xl mx-auto p-2 rounded-lg mt-2">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8">Tambah Produk</h1>

        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            <div>
                <x-forms.input label="Nama Produk" id="name" name="name" />
                <x-forms.input label="Harga" id="harga" name="price" />
                <x-forms.input label="Stok" id="stok" name="stock" />
                <x-forms.input label="Deskripsi" id="deskripsi" name="description" />

                <!-- Pilih Kategori -->
                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Pilih Kategori</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                <div class="mb-6">
                    <label for="image" class="block text-gray-700 text-lg font-semibold">Upload Gambar</label>
                    <input type="file" id="image" name="image" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" onchange="previewImage(event)">
                    @error('image')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-info transition">
                    Submit
                </button>
            </div>

            <!-- Preview Gambar -->
            <div class="flex items-center justify-center">
                <img id="imagePreview" src="#" alt="Preview" class="hidden w-full h-auto rounded-lg shadow-lg object-cover" />
            </div>
        </form>
    </main>

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.classList.add('hidden');
            }
        }
    </script>
</x-seller-app>
