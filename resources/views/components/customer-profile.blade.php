<div class="relative group">
    <button class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
        <img src="https://via.placeholder.com/40" alt="User Avatar" class="rounded-full h-10 w-10 object-cover">
        <span class="ml-2">@auth {{ Auth::user()->name }} @endauth</span>
    </button>

    <div class="relative">
        <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden z-50">
          
            @auth
            {{-- <a href="{{ route('customer.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 focus:outline-none">Profile</a> --}}
            
            @if(auth()->user()->role === 'seller')
                <a href="{{ route('seller.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 focus:outline-none">Seller Dashboard</a>
            @endif

            @if(auth()->user()->role === 'customer')
                <a href="{{ route('customer.order.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 focus:outline-none">Your Orders</a>
            @endif
            @endauth

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 focus:outline-none">Logout</button>
            </form>
        </div>
    </div>
</div>

<script>
    const dropdownButton = document.querySelector('.relative > button');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', (event) => {
        event.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
        const isClickInside = dropdownButton.contains(event.target) || dropdownMenu.contains(event.target);

        if (!isClickInside) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>

<style>
    #dropdownMenu a, #dropdownMenu button {
        transition: background-color 0.3s ease;
    }

    #dropdownMenu a:hover, #dropdownMenu button:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
</style>
