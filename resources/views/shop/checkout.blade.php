<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - DemoShop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Header Section -->
    <header class="bg-gradient-to-r from-orange-600 to-orange-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-800" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold">DemoShop</h1>
                </div>

                <!-- Navigation -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('shop.index') }}" class="text-white/80 hover:text-white transition-colors">Shop</a>
                    <a href="{{ route('cart.view') }}" class="text-white/80 hover:text-white transition-colors">Cart</a>
                    <a href="#" class="text-white/80 hover:text-white transition-colors">About</a>
                </div>

                <!-- Cart Icon -->
                <div class="relative">
                    <a href="{{ route('cart.view') }}" class="flex items-center space-x-2 bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"/>
                        </svg>
                        <span class="font-medium">Cart</span>
                        <span class="bg-red-500 text-white text-xs rounded-full h-6 w-6 flex items-center justify-center font-bold">{{ count(session()->get('cart', [])) }}</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Checkout</h1>
                <p class="text-gray-600">Complete your purchase with secure checkout</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Checkout Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Shipping Information</h2>
                        </div>
                        
                        <form action="{{ route('checkout.process') }}" method="POST" class="p-6">
                            @csrf
                            
                            <!-- Personal Information -->
                            <div class="mb-6">
                                <h3 class="text-md font-medium text-gray-900 mb-4">Personal Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                        <input type="text" id="first_name" name="first_name" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                        <input type="text" id="last_name" name="last_name" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="mb-6">
                                <h3 class="text-md font-medium text-gray-900 mb-4">Contact Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                        <input type="email" id="email" name="email" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                        <input type="tel" id="phone" name="phone" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Address -->
                            <div class="mb-6">
                                <h3 class="text-md font-medium text-gray-900 mb-4">Shipping Address</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Street Address</label>
                                        <input type="text" id="address" name="address" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                            <input type="text" id="city" name="city" required
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                                            <input type="text" id="state" name="state" required
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-2">ZIP/Postal Code</label>
                                            <input type="text" id="zip_code" name="zip_code" required
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Information -->
                            <div class="mb-6">
                                <h3 class="text-md font-medium text-gray-900 mb-4">Payment Information</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label for="card_number" class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                                        <input type="text" id="card_number" name="card_number" required placeholder="1234 5678 9012 3456"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label for="expiry" class="block text-sm font-medium text-gray-700 mb-2">Expiry Date</label>
                                            <input type="text" id="expiry" name="expiry" required placeholder="MM/YY"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label for="cvv" class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                            <input type="text" id="cvv" name="cvv" required placeholder="123"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label for="card_name" class="block text-sm font-medium text-gray-700 mb-2">Name on Card</label>
                                            <input type="text" id="card_name" name="card_name" required
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                <a href="{{ route('cart.view') }}" 
                                   class="text-orange-600 hover:text-orange-700 font-medium transition-colors">
                                    ← Back to Cart
                                </a>
                                <button type="submit" 
                                        class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                                    Complete Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                        
                        <!-- Cart Items Preview -->
                        <div class="space-y-3 mb-6">
                            @php
                                $subtotal = 0;
                                $cart = session()->get('cart', []);
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
                            
                            @foreach($cart as $productId => $item)
                                @php
                                    $product = \App\Models\Product::find($productId);
                                @endphp
                                @if($product)
                                <div class="flex items-center space-x-3 py-2">
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex-shrink-0">
                                        @if($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-full bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</h4>
                                        <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">QAR {{ number_format($product->price * $item['quantity'], 2) }}</span>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        
                        <!-- Price Breakdown -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">QAR {{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium">Free</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tax (5%)</span>
                                <span class="font-medium">QAR {{ number_format($tax, 2) }}</span>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between text-lg font-bold">
                                    <span>Total</span>
                                    <span class="text-orange-600">QAR {{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Security Notice -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-600">Secure checkout with SSL encryption</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


