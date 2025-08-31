<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">Products</h1>
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Add Product</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr>
                            <td class="px-4 py-3">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/'.$product->image_path) }}" class="h-12 w-12 object-cover rounded" />
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $product->name }}</td>
                            <td class="px-4 py-3">QAR {{ number_format($product->price, 2) }}</td>
                            <td class="px-4 py-3">{{ $product->stock }}</td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</x-app-layout>


