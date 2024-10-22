<div class="mb-4">
    <label for="{{$id}}" class="block text-gray-700">{{ $label }}</label>

    <input
        type="text"
        id="{{ $id }}"
        name="{{$name}}"
        value="{{$value ?? ''}}"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        
        @error($name)
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
</div>