<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

// Basic routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('Login');
})->name('login');

Route::get('/register', function () {
    return view('Register');
})->name('register');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Order routes - Note the reordered routes
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

// Order items routes
Route::post('/orders/{order}/items', [OrderItemController::class, 'store'])->name('orderItems.store');
Route::delete('/orders/{order}/items/{item}', [OrderItemController::class, 'destroy'])->name('orderItems.destroy');

// Test route
Route::get('/test-order', [OrderController::class, 'testCreate'])->name('orders.test');

use App\Http\Controllers\ShoppingCartController;

// Shopping Cart routes
Route::post('/cart/add', [ShoppingCartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [ShoppingCartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/{customerId}', [ShoppingCartController::class, 'getCart'])->name('cart.get');
Route::delete('/cart/{customerId}', [ShoppingCartController::class, 'clearCart'])->name('cart.clear');
Route::put('/cart/update-quantity', [ShoppingCartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::get('/test-cart', [ShoppingCartController::class, 'testCart'])->name('cart.test');
Route::get('/cart', function () {
    return view('cart.cart');
})->name('cart.view');