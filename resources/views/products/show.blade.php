<x-customer-app>
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <main class="container mx-auto py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="col-span-1">
                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-md shadow-md">
            </div>

            <div class="col-span-1">
                <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
                <p class="text-gray-900 font-bold text-3xl mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
                    <p class="text-gray-700 mb-4">
                        {{ Str::limit($product->description, 150, '...') }}
                    </p>
                </div>
            </div>

            <div class="col-span-1 bg-gray-100 p-4 rounded-lg shadow-md">
                <div class="flex flex-col items-center space-y-4">
  
                    <p class="text-gray-500 mb-4">Stock: <span class="font-semibold">{{ $product->stock }}</span></p>

                    <p id="total-price" class="text-lg font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                    <div class="flex space-x-2">
                        <form action="{{ route('customer.cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-secondary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-customer-app>
