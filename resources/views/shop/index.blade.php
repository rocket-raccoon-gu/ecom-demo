<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DemoShop - Modern E-commerce</title>
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

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-8">
                    <div class="flex">
                        <input type="text" placeholder="Find your product" 
                               class="flex-1 px-4 py-2 rounded-l-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <select class="px-4 py-2 bg-white text-gray-700 border-l border-gray-300 focus:outline-none">
                            <option>All Categories</option>
                            <option>Electronics</option>
                            <option>Fashion</option>
                            <option>Home & Garden</option>
                        </select>
                        <button class="px-6 py-2 bg-gray-800 text-white rounded-r-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Cart Icon -->
                <div class="relative">
                    <a href="{{ route('cart.view') }}" class="flex items-center space-x-2 bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"/>
                        </svg>
                        <span class="font-medium">Cart</span>
                        <span id="cart-count" class="bg-red-500 text-white text-xs rounded-full h-6 w-6 flex items-center justify-center font-bold">0</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Home</a>
                    <a href="#" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Shop</a>
                    <a href="#" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Categories</a>
                    <a href="#" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">About</a>
                    <a href="#" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Contact</a>
                </div>
                
                <!-- Promotional Banner -->
                <div class="bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-2 rounded-full">
                    <span class="font-bold">BLACK FRIDAY</span>
                    <span class="ml-2">Get 45% Off!</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-4xl mx-auto">
                <div class="inline-block bg-orange-500 text-white px-6 py-2 rounded-full text-sm font-semibold mb-6">
                    Up to 30% Off
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-8 leading-tight">
                    Let's make home happy
                </h1>
                <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                    Discover amazing products that bring joy and comfort to your everyday life
                </p>
                <button class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-colors transform hover:scale-105">
                    VIEW COLLECTIONS
                </button>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Featured Products</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Explore our carefully curated collection of premium products designed to enhance your lifestyle
                </p>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden rounded-t-xl">
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Quick Add Button -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                            <button onclick="addToCart({{ $product->id }}, this)" 
                                    class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold transform scale-0 group-hover:scale-100 transition-all duration-300 hover:bg-orange-600">
                                Quick Add
                            </button>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <div class="text-sm text-gray-500 mb-2">Featured Product</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-orange-600">QAR {{ number_format($product->price, 2) }}</span>
                            <div class="flex items-center space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        
                        <!-- Add to Cart Form -->
                        <form onsubmit="addToCart({{ $product->id }}, this)" class="flex items-center space-x-3">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                   class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <button type="submit" 
                                    class="flex-1 bg-gray-900 hover:bg-gray-800 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Stay Updated</h3>
            <p class="text-gray-600 mb-8">Get the latest product updates and exclusive offers delivered to your inbox</p>
            <div class="max-w-md mx-auto flex">
                <input type="email" placeholder="Enter your email" 
                       class="flex-1 px-4 py-3 rounded-l-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <button class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-r-lg font-medium transition-colors">
                    Subscribe
                </button>
            </div>
        </div>
    </section>

    <!-- Success Toast -->
    <div id="success-toast" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>Added to cart successfully!</span>
        </div>
    </div>

    <script>
    function addToCart(productId, button) {
        event.preventDefault();
        
        const form = button.closest('form');
        const quantity = form.querySelector('input[name="quantity"]').value;
        
        // Show loading state
        button.disabled = true;
        button.textContent = 'Adding...';
        
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update cart count
                const cartCount = document.getElementById('cart-count');
                cartCount.textContent = data.cartCount;
                cartCount.classList.add('animate-pulse');
                setTimeout(() => cartCount.classList.remove('animate-pulse'), 1000);
                
                // Show success toast
                const toast = document.getElementById('success-toast');
                toast.classList.remove('translate-x-full');
                setTimeout(() => toast.classList.add('translate-x-full'), 3000);
                
                // Reset form
                form.querySelector('input[name="quantity"]').value = 1;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
        .finally(() => {
            button.disabled = false;
            button.textContent = 'Add to Cart';
        });
    }

    // Fetch initial cart count
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count').textContent = data.count;
            })
            .catch(error => console.error('Error fetching cart count:', error));
    });
    </script>
</body>
</html>


