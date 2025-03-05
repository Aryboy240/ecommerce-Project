<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Test routes for the product searching page
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Basic routes

// login system routes - Aryan
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);


// Routes to other pages
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/welcome', function () {
    return view('welcome'); // Refers to resources/views/welcome.blade.php
})->name('welcome');

Route::get('/about', function () {
    return view('about'); // Refers to resources/views/about.blade.php
})->name('about');

Route::get('/contact', function () {
    return view('Contact'); // Refers to resources/views/contact.blade.php
})->name('contact');

Route::get('/checkout', function () {
    return view('Checkout');
})->name('checkout');

Route::get('/shoppingCart', function () {
    return view('Cart'); // Refers to resources/views/contact.blade.php
})->name('shoppingCart');

/*
|--------------------------------------------------------------------------
| Products Page
|--------------------------------------------------------------------------
*/

Route::get('/product', function () {
    $products = Product::with('images', 'category')->get(); // Fetch products with relationships
    return view('Product', ['products' => $products]);  // Pass data to the view with the correct variable name
})->name('product');

Route::get('/sproduct', function () {
    $products = Product::with('images', 'category')->get();
    return view('sproduct', ['products' => $products]);
})->name('sproduct');

Route::get('/sproduct/{id}', [ProductController::class, 'show'])->name('product.details');

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('Login'); // Refers to resources/views/Login.blade.php
})->name('login');

Route::get('/register', function () {
    return view('Register'); // Refers to resources/views/Register.blade.php
})->name('register');

Route::get('/account', function () {
    return view('Account'); // Refers to resources/views/Account.blade.php
})->name('account');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){
    Route::post('/update-username',[UserController::class, 'updateUsername'])->name('update.username');
    Route::post('/update-email',[UserController::class, 'updateEmail'])->name('update.email');
    Route::post('/update-password',[UserController::class, 'updatePassword'])->name('update.password');
});

/*
|--------------------------------------------------------------------------
| Search Routes
|--------------------------------------------------------------------------
*/

Route::get('/search', function () {
    $products = Product::with('images', 'category')->get(); // Fetch products with relationships
    return view('search', ['products' => $products]); // Pass data to the view with the correct variable name
})->name('search');

/*
|--------------------------------------------------------------------------
| Order Routes
|--------------------------------------------------------------------------
*/

Route::prefix('orders')->group(function () {
    Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    Route::put('/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
    // Order items routes
    Route::post('/{order}/items', [OrderItemController::class, 'store'])->name('orderItems.store');
    Route::delete('/{order}/items/{item}', [OrderItemController::class, 'destroy'])->name('orderItems.destroy');
});

/*
|--------------------------------------------------------------------------
| Shopping Cart Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('cart')->group(function () {
    Route::get('/', [ShoppingCartController::class, 'getCart'])->name('cart.view');
    Route::post('/add', [ShoppingCartController::class, 'addToCart'])->name('cart.add');
    Route::post('/update', [ShoppingCartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/remove', [ShoppingCartController::class, 'removeFromCart'])->name('cart.remove');
});

// Additions from homepage featured products
Route::get('/welcome', [ShoppingCartController::class, 'showHomePage'])->name('welcome');
Route::middleware(['auth'])->prefix('welcome')->group(function () {
    Route::post('/add', [ShoppingCartController::class, 'addToCart'])->name('cart.add');
});

Route::get('/check-login', [UserController::class, 'checkLogin']);
Route::get('/check-login', function () {
    return response()->json(['logged_in' => auth()->check()]);
});


// Checkout Page
Route::get('/checkout', [ShoppingCartController::class, 'checkout'])->name('checkout');