<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = \App\Models\Product::latest()->paginate(12);
    return view('shop.index', compact('products'));
})->name('shop.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';

// Public cart routes
Route::post('/cart/add/{product}', function (\App\Models\Product $product, \Illuminate\Http\Request $request) {
    $quantity = max(1, (int) $request->input('quantity', 1));
    // Append to existing cart so multiple items are kept
    $cart = session()->get('cart', []);
    if (!isset($cart[$product->id])) {
        $cart[$product->id] = ['product_id' => $product->id, 'name' => $product->name, 'price' => $product->price, 'image_path' => $product->image_path, 'quantity' => 0];
    }
    $cart[$product->id]['quantity'] += $quantity;
    session(['cart' => $cart]);
    $count = collect($cart)->sum('quantity');
    if ($request->expectsJson()) {
        return response()->json(['count' => $count, 'message' => 'Added to cart']);
    }
    return back()->with('success', 'Added to cart');
})->name('cart.add');

Route::get('/cart', function () {
    $cart = session('cart', []);
    return view('shop.cart', compact('cart'));
})->name('cart.view');

Route::post('/cart/update/{productId}', function ($productId, \Illuminate\Http\Request $request) {
    $cart = session()->get('cart', []);
    $change = (int) $request->input('change', 0);
    
    if (isset($cart[$productId])) {
        $newQuantity = $cart[$productId]['quantity'] + $change;
        
        if ($newQuantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId]['quantity'] = $newQuantity;
        }
        
        session(['cart' => $cart]);
        
        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }
    }
    
    return back();
})->name('cart.update');

Route::get('/checkout', function () {
    $cart = session('cart', []);
    return view('shop.checkout', compact('cart'));
})->name('checkout');

Route::post('/checkout', function (\Illuminate\Http\Request $request) {
    // For demo purposes, just redirect back with success message
    return redirect()->route('shop.index')->with('success', 'Order placed successfully! This is a demo checkout.');
})->name('checkout.process');

// Cart remove route
Route::post('/cart/remove/{productId}', function ($productId) {
    $cart = session()->get('cart', []);
    if (isset($cart[$productId])) {
        unset($cart[$productId]);
        session(['cart' => $cart]);
    }
    return response()->json(['success' => true]);
})->name('cart.remove');

// Cart clear route
Route::post('/cart/clear', function () {
    session()->forget('cart');
    return redirect()->route('shop.index')->with('success', 'Cart cleared successfully!');
})->name('cart.clear');

// Cart count (for header badge)
Route::get('/cart/count', function () {
    return ['count' => collect(session('cart', []))->sum('quantity')];
})->name('cart.count');
