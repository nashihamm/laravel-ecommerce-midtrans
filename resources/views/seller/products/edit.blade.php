<x-seller-app>
    {{-- <x-toast /> --}}
    <main class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8">Edit Produk: {{ $product->name }}</h1>

        <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Menggunakan PUT untuk update -->

            <x-forms.input label="Nama Produk" id="name" name="name" value="{{ old('name', $product->name) }}" />
            <x-forms.input label="Harga" id="harga" name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}" />
            <x-forms.input label="Stok" id="stok" name="stock" type="number" value="{{ old('stock', $product->stock) }}" />
            <x-forms.input label="Deskripsi" id="deskripsi" name="description" value="{{ old('description', $product->description) }}" />

            <!-- Pilih Kategori -->
            <div class="mb-6">
                <!-- Category Dropdown -->
                <label for="category_id" class="block text-sm font-medium text-gray-700">Select Category</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category_id')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Upload Gambar -->
            <div class="mb-6">
                <label for="image" class="block text-gray-700 text-lg font-semibold">Upload Gambar</label>
                <input type="file" id="image" name="image" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('image')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                @if($product->image)
                    <p class="mt-2 text-sm text-gray-600">Current Image:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover mt-1">
                @endif
            </div>

            <button type="submit" class="btn btn-dark">
                Update
            </button>
        </form>
    </main>
</x-seller-app>
