<x-seller-app>
<main>
    
<h1 class=""text-2xl font-bold>Tambah Kategori</h1>

<form action="{{ route('seller.categories.store') }}" method="POST">
    @csrf
    <x-forms.input label="Nama Produk" id="name" name="name" />
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
</main>

</x-seller-app>