<x-seller-app>
<main>
<h1 class="text-2xl font-bold">Edit Kategori</h1>

<form action="{{ route('seller.categories.update', $category->name) }}" method="POST">
    @csrf
    @method('PUT')
    <x-forms.input label="Product Name" id="name" name="name" value="{{ $category->name }}" />
    <button type="submit" class="btn btn-info">Update</button>
</form>
</main>
</x-seller-app>
