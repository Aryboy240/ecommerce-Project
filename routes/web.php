<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Models\Product;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/



// Test route for product images
Route::get('/test', function () {
    // Fetch all products along with their images and image types
    $products = App\Models\Product::with(['images.imageType'])->get();
    return view('test', ['products' => $products]);
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

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

Route::get('/product', function () {
    return view('Product'); // Refers to resources/views/Product.blade.php
})->name('product');

Route::get('/sproduct', function () {
    return view('sproduct'); // Refers to resources/views/sproduct.blade.php
})->name('sproduct');

Route::get('/welcome', function () {
    return view('welcome'); // Refers to resources/views/welcome.blade.php
})->name('welcome');

Route::get('/contact', function () {
    return view('Contact'); // Refers to resources/views/contact.blade.php
})->name('contact');

/*
|--------------------------------------------------------------------------
| Search Routes
|--------------------------------------------------------------------------
*/

Route::get('/search', function () {
    return view('Search'); // Refers to resources/views/search.blade.php
})->name('search');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

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
