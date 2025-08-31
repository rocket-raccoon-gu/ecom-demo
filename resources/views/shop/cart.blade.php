<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shopping Cart - DemoShop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Header Section -->
    <header class="bg-gradient-to-r from-blue-600 to-purple-700 text-white shadow-xl">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-blue-800" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white">DemoShop</h1>
                </div>

                <!-- Navigation -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('shop.index') }}" class="text-white hover:text-yellow-200 transition-colors font-medium">Shop</a>
                    <a href="#" class="text-white hover:text-yellow-200 transition-colors font-medium">Categories</a>
                    <a href="#" class="text-white hover:text-yellow-200 transition-colors font-medium">About</a>
                </div>

                <!-- Cart Icon -->
                <div class="relative">
                    <a href="{{ route('cart.view') }}" class="flex items-center space-x-2 bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition-colors shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"/>
                        </svg>
                        <span class="font-medium text-white">Cart</span>
                        <span class="bg-red-500 text-white text-xs rounded-full h-6 w-6 flex items-center justify-center font-bold shadow-lg">{{ count($cart) }}</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="min-h-screen bg-gray-100 py-8">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">🛒 Shopping Cart</h1>
                <p class="text-lg text-gray-700 font-medium">Review your items and proceed to checkout</p>
            </div>

            @if(count($cart) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50">
                                <h2 class="text-xl font-bold text-gray-800">Cart Items ({{ count($cart) }})</h2>
                            </div>
                            
                            <div class="divide-y divide-gray-200">
                                @foreach($cart as $productId => $item)
                                    @php
                                        $product = \App\Models\Product::find($productId);
                                    @endphp
                                    @if($product)
                                    <div class="p-6 flex items-center space-x-4 hover:bg-gray-50 transition-colors" id="cart-item-{{ $product->id }}">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0">
                                            @if($product->image_path)
                                                <img src="{{ asset('storage/' . $product->image_path) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="w-24 h-24 object-cover rounded-xl shadow-md">
                                            @else
                                                <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl flex items-center justify-center shadow-md">
                                                    <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                                            <p class="text-sm text-gray-600 font-medium">Stock: {{ $product->stock }} available</p>
                                            <div class="mt-3">
                                                <span class="text-2xl font-bold text-blue-600">QAR {{ number_format($product->price, 2) }}</span>
                                            </div>
                                        </div>

                                        <!-- Quantity Controls -->
                                        <div class="flex items-center space-x-3">
                                            <button onclick="updateQuantity({{ $product->id }}, -1)" 
                                                    class="w-10 h-10 rounded-full border-2 border-blue-300 flex items-center justify-center hover:bg-blue-50 hover:border-blue-400 transition-colors shadow-md">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                </svg>
                                            </button>
                                            
                                            <span class="text-xl font-bold text-gray-800 w-14 text-center bg-gray-100 py-2 rounded-lg">{{ $item['quantity'] }}</span>
                                            
                                            <button onclick="updateQuantity({{ $product->id }}, 1)" 
                                                    class="w-10 h-10 rounded-full border-2 border-blue-300 flex items-center justify-center hover:bg-blue-50 hover:border-blue-400 transition-colors shadow-md">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Remove Button -->
                                        <button onclick="removeItem({{ $product->id }})" 
                                                class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-full transition-colors">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Continue Shopping -->
                        <div class="mt-6 text-center">
                            <a href="{{ route('shop.index') }}" 
                               class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 font-bold text-lg transition-colors bg-blue-50 hover:bg-blue-100 px-6 py-3 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                <span>Continue Shopping</span>
                            </a>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-2xl p-6 sticky top-8 border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">📋 Order Summary</h3>
                            
                            <div class="space-y-4 mb-6">
                                @php
                                    $subtotal = 0;
                                    foreach($cart as $productId => $item) {
                                        $product = \App\Models\Product::find($productId);
                                        if($product) {
                                            $subtotal += $product->price * $item['quantity'];
                                        }
                                    }
                                    $shipping = 0;
                                    $tax = $subtotal * 0.05; // 5% tax
                                    $total = $subtotal + $shipping + $tax;
                                @endphp
                                
                                <div class="flex justify-between text-base">
                                    <span class="text-gray-700 font-medium">Subtotal</span>
                                    <span class="font-bold text-gray-800">QAR {{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-base">
                                    <span class="text-gray-700 font-medium">Shipping</span>
                                    <span class="font-bold text-green-600">Free</span>
                                </div>
                                <div class="flex justify-between text-base">
                                    <span class="text-gray-700 font-medium">Tax (5%)</span>
                                    <span class="font-bold text-gray-800">QAR {{ number_format($tax, 2) }}</span>
                                </div>
                                
                                <div class="border-t-2 border-gray-300 pt-4">
                                    <div class="flex justify-between text-xl font-bold">
                                        <span class="text-gray-800">Total</span>
                                        <span class="text-blue-600">QAR {{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <a href="{{ route('checkout') }}" 
                               class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-xl transition-all text-center block shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                🚀 Proceed to Checkout
                            </a>

                            <!-- Clear Cart -->
                            <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" 
                                        class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-4 rounded-xl transition-colors shadow-md hover:shadow-lg">
                                    🗑️ Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="text-center py-20">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-xl">
                        <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Your cart is empty</h2>
                    <p class="text-xl text-gray-700 mb-10 font-medium">Looks like you haven't added any products to your cart yet.</p>
                    <a href="{{ route('shop.index') }}" 
                       class="inline-flex items-center space-x-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold px-10 py-4 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <span>Start Shopping</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
    function updateQuantity(productId, change) {
        fetch(`/cart/update/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ change: change })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Refresh to show updated quantities
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function removeItem(productId) {
        if (confirm('Are you sure you want to remove this item?')) {
            fetch(`/cart/remove/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Fade out animation
                    const item = document.getElementById(`cart-item-${productId}`);
                    item.style.transition = 'all 0.3s ease';
                    item.style.opacity = '0';
                    item.style.transform = 'translateX(-100%)';
                    
                    setTimeout(() => {
                        location.reload();
                    }, 300);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
    </script>
</body>
</html>


