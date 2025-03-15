<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Models\Product;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [ProductController::class, 'featuredProducts'])->name('welcome');
Route::get('/welcome', [ProductController::class, 'featuredProducts'])->name('welcome'); // This sends the 'featured products' information to the homepage

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

Route::get('/Careers', function () {
    return view('extras/Careers'); // Refers to resources/views/Careers.blade.php
})->name('Careers');

Route::get('/Testimonials', function () {
    return view('extras/Testimonials'); // Refers to resources/views/Testimonials.blade.php
})->name('Testimonials');

Route::get('/OurStory', function () {
    return view('extras/OurStory'); // Refers to resources/views/OurStory.blade.php
})->name('OurStory');

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

Route::post('/reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

Route::post('/sproduct/{id}/review', [ReviewController::class, 'store'])->name('review.store');

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

// Account Management Routes
Route::middleware(['auth'])->group(function () {
    // Account Page
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    
    // Update Username
    Route::post('/account/update-username', [AccountController::class, 'updateUsername'])
        ->name('update.username');
    
    // Update Password
    Route::post('/account/update-password', [AccountController::class, 'updatePassword'])
        ->name('update.password');
    
    // Update Email
    Route::post('/account/update-email', [AccountController::class, 'updateEmail'])
        ->name('update.email');
    
    // Update Personal Info
    Route::post('/account/update-personal-info', [AccountController::class, 'updatePersonalInfo'])
        ->name('update.personal-info');
    
    // Update Profile Picture
    Route::post('/account/update-profile-picture', [AccountController::class, 'updateProfilePicture'])
        ->name('update.profile-picture');
    
    // Update Billing Address
    Route::post('/account/update-billing-address', [AccountController::class, 'updateBillingAddress'])
        ->name('update.billing-address');
});

/*
|--------------------------------------------------------------------------
| Admin Account Routes
|--------------------------------------------------------------------------
*/

// Admin login route
Route::get('/adminlogin', function () {
    return view('admin/Adminlogin'); // Refers to resources/views/adminlogin.blade.php
})->name('adminlogin');

// Admin post login route
Route::post('/adminlogin', [AdminController::class, 'adminLogin'])->name('adminlogin.post');

// Admin panel route
Route::get('/adminpanel', function () {
    return view('admin/AdminPanel');
})->name('adminpanel');

Route::get('/productadmin', function () {
    return view('admin/AdminProduct'); 
})->name('productadmin');

// Order Management Route
Route::get('/AdminOrders', function () {
    return view('admin/AdminOrder');
})->name('AdminOrders');

Route::get('/adminprofile', function () {
    return view('admin/AdminProfile');
})->name('adminprofile');

// Customer Management Route
Route::get('/customers', function () {
    return view('admin/AdminCustomers'); 
})->name('customers');

// Report Route
Route::get('/adminreport', [App\Http\Controllers\OrderController::class, 'adminReport'])->name('adminreport');

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
    Route::put('/{order}/status', [OrderController::class, 'updateOrderStatus'])->name('orders.updateStatus');
    Route::post('/{order}/refund', [OrderController::class, 'refund'])->name('orders.refund');
    
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

Route::get('/check-login', [UserController::class, 'checkLogin']);
Route::get('/check-login', function () {
    return response()->json(['logged_in' => auth()->check()]);
});

// Checkout Page
Route::get('/checkout', [ShoppingCartController::class, 'checkout'])->name('checkout');