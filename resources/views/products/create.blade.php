<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Add Product</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf
            <div>
                <label class="block text-sm font-medium">Name</label>
                <input name="name" value="{{ old('name') }}" class="mt-1 w-full border rounded px-3 py-2" />
                @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" class="mt-1 w-full border rounded px-3 py-2" rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Price</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="mt-1 w-full border rounded px-3 py-2" />
                    @error('price')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" class="mt-1 w-full border rounded px-3 py-2" />
                    @error('stock')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium">Image</label>
                <input type="file" name="image" class="mt-1" />
                @error('image')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            <div class="flex items-center gap-3">
                <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Save</button>
                <a href="{{ route('products.index') }}" class="text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>


