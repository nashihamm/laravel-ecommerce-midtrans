<x-seller-app>
    <main>
        <div class="container mx-auto py-8">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">List Kategori</h1>
            <a href="{{ route('seller.categories.create') }}" class="mb-4 bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-500 transition">
                Tambah Kategori
            </a>
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2 text-left">ID</th>
                            <th class="border px-4 py-2 text-left">Nama</th>
                            <th class="border px-4 py-2 text-left">Slug</th>
                            <th class="border px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $data)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="border px-4 py-2">{{ $data->id }}</td>
                                <td class="border px-4 py-2">{{ $data->name }}</td>
                                <td class="border px-4 py-2">{{ $data->slug }}</td>
                                <td class="border px-4 py-2 flex space-x-2">
                                    <a href="{{ route('seller.categories.edit', $data->id) }}" class="text-blue-500 hover:text-blue-700">
                                        <!-- Ikon Edit -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('seller.categories.destroy', $data->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700 focus:outline-none" type="submit">
                                            <!-- Ikon Hapus -->
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
            </div>
        </div>
    </main>
</x-seller-app>

<script>
    function confirmDelete() {
        return confirm('Apakah Anda yakin ingin menghapus kategori ini?');
    }
</script>
