<x-customer-app>

    <main class="container mx-auto py-8">

        <h1 class="text-5xl font-extrabold mb-10 text-center text-gray-800">{{ $category->name }}</h1>

        @if ($products->isEmpty())
            <p class="text-gray-500 text-center text-lg">Tak ada produk dengan kategori <strong>{{ $category->name }}</strong> saat ini.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <div class="bg-white border border-gray-200 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
                        <a href="{{ route('product.show', $product->id) }}">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2 truncate">{{ $product->name }}</h2>
                            <p class="text-gray-600 mb-3">{{ Str::limit($product->description, 50) }}</p>
                            <p class="text-gray-900 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-gray-500 mb-4">Stock: {{ $product->stock }}</p>
                        </a>
                        <a href="{{ route('product.show', $product->id) }}" class="block text-center bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">View Details</a>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</x-customer-app>
