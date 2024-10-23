<aside class="w-64 bg-gray-800 text-gray-100 flex-shrink-0">
    <div class="p-6">
        <h2 class="text-lg font-semibold">Seller Panel</h2>
    </div>
    <nav class="mt-6">
        <x-sidebar-link href="{{ route('seller.products.index') }}" :active="request()->routeIs('seller.products.index')">
            Products
        </x-sidebar-link>
        <x-sidebar-link href="{{ route('seller.categories.index') }}" :active="request()->routeIs('seller.categories.index')">
            Categories
        </x-sidebar-link>
        <x-sidebar-link href="{{ route('seller.orders.index') }}" :active="request()->routeIs('seller.orders.index')">
            Orders
        </x-sidebar-link>
    </nav>
    <div class="mt-auto p-6">
        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Are you sure you want to logout?');">
            @csrf
            <button type="submit" class="w-full text-left text-red-500 hover:bg-gray-700 rounded-md p-2">
                Logout
            </button>
        </form>
    </div>
</aside>
