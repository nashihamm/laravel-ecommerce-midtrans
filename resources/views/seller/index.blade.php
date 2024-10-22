<x-seller-app>
<main>

<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Dashboard Seller</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold">Selamat Datang, {{ auth()->user()->name }}!</h2>
        <p class="mt-2">Ini adalah dashboard Anda untuk mengelola produk dan kategori.</p>
        
        <div class="mt-4">
            <a href="{{ route('seller.products.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Kelola Produk
            </a>
            <a href="{{ route('seller.categories.index') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-4">
                Kelola Kategori
            </a>
            <a href="{{ route('seller.orders.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 ml-4">
                Lihat Pesanan
            </a>
        </div>
    </div>
</div>
</main>
</x-seller-app>