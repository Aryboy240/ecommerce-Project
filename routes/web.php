<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

// Basic routes

// login system routes - Aryan
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout' , [UserController::class, 'logout']);
Route::post('/login' , [UserController::class, 'login']);

// Routes to other pages
Route::get('/', function () {
    return view('welcome'); // Homepage
});

Route::get('/login', function () {
    return view('Login'); // Refers to resources/views/Login.blade.php
})->name('login');

Route::get('/register', function () {
    return view('Register'); // Refers to resources/views/Register.blade.php
})->name('register');

Route::get('/welcome', function () {
    return view('welcome'); // Refers to resources/views/welcome.blade.php
})->name('welcome');

Route::get('/contact', function () {
    return view('Contact'); // Refers to resources/views/contact.blade.php
})->name('contact');

Route::get('/shoppingCart', function () {
    return view('Cart'); // Refers to resources/views/contact.blade.php
})->name('shoppingCart');

// Order routes - Note the reordered routes - Vatsal
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
Route::post('/add-to-cart', [ShoppingCartController::class, 'addToCart'])->name('cart.add');

