<!-- Button to open modal -->
<button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600" onclick="openModal('addProductModal')">Add Product</button>

<!-- Modal Component -->
<x-modal id="addProductModal" title="Add New Product">
    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
        </div>
        <!-- Other form fields -->
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
        </div>
    </form>
</x-modal>
