<aside class="w-64 bg-gray-100 text-gray-700 py-8 px-6">
    <h2 class="text-2xl font-bold mb-6">Categories</h2>
    <ul class="space-y-4">
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('category.show', $category->slug) }}" class="block hover:text-gray-400">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>