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

// User Authentication Routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Home & Landing Pages
Route::get('/', [ProductController::class, 'featuredProducts'])->name('welcome');
Route::get('/welcome', [ProductController::class, 'featuredProducts'])->name('welcome'); // This sends the 'featured products' information to the homepage
Route::get('/get-products-by-face-shape', [ProductController::class, 'getProductsByFaceShape']);

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('Contact');
})->name('contact');

Route::get('/checkout', function () {
    return view('Checkout');
})->name('checkout');

Route::get('/shoppingCart', function () {
    return view('Cart');
})->name('shoppingCart');

Route::get('/Careers', function () {
    return view('extras/Careers');
})->name('Careers');

Route::get('/Testimonials', function () {
    return view('extras/Testimonials');
})->name('Testimonials');

Route::get('/OurStory', function () {
    return view('extras/OurStory');
})->name('OurStory');

/*
|--------------------------------------------------------------------------
| Products Page
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/sproduct/{id}', [ProductController::class, 'show'])->name('product.details');
Route::post('/reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
Route::post('/sproduct/{id}/review', [ReviewController::class, 'store'])->name('review.store');

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('Login');
})->name('login');

Route::get('/register', function () {
    return view('Register');
})->name('register');

Route::get('/account', function () {
    return view('Account');
})->name('account');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/update-username', [UserController::class, 'updateUsername'])->name('update.username');
    Route::post('/update-email', [UserController::class, 'updateEmail'])->name('update.email');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update.password');
});

// Account Management Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account/update-username', [AccountController::class, 'updateUsername'])->name('update.username');
    Route::post('/account/update-password', [AccountController::class, 'updatePassword'])->name('update.password');
    Route::post('/account/update-email', [AccountController::class, 'updateEmail'])->name('update.email');
    Route::post('/account/update-personal-info', [AccountController::class, 'updatePersonalInfo'])->name('update.personal-info');
    Route::post('/account/update-profile-picture', [AccountController::class, 'updateProfilePicture'])->name('update.profile-picture');
    Route::post('/account/update-billing-address', [AccountController::class, 'updateBillingAddress'])->name('update.billing-address');
});

/*
|--------------------------------------------------------------------------
| Admin Account Routes
|--------------------------------------------------------------------------
*/
Route::get('/adminlogin', function () {
    return view('admin/Adminlogin');
})->name('adminlogin');

Route::post('/adminlogin', [AdminController::class, 'adminLogin'])->name('adminlogin.post');
Route::get('/adminpanel', function () {
    return view('admin/AdminPanel');
})->name('adminpanel');

Route::get('/admin/products', [ProductController::class, 'index'])->name('productadmin');

Route::get('/AdminOrders', function () {
    return view('admin/AdminOrder');
})->name('AdminOrders');

Route::get('/adminprofile', function () {
    return view('admin/AdminProfile');
})->name('adminprofile');

Route::get('/customers', function () {
    return view('admin/AdminCustomers');
})->name('customers');

// Report Route
Route::get('/adminreport', [App\Http\Controllers\OrderController::class, 'adminReport'])->name('adminreport');

// Product Admin Routes
Route::post('/admin/products', [ProductController::class, 'store'])->name('productadmin.store');
Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('productadmin');
Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('productadmin.update');
Route::put('/admin/products/update-stock/{id}', [ProductController::class, 'updateStock'])->name('productadmin.updateStock'); 
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('productadmin.destroy');

/*
|--------------------------------------------------------------------------
| Search Routes
|--------------------------------------------------------------------------
*/
Route::get('/search', function () {
    $products = Product::with('images', 'category')->get();
    return view('search', ['products' => $products]);
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

// Login Check API
Route::get('/check-login', function () {
    return response()->json(['logged_in' => auth()->check()]);
});

// Checkout Page
Route::get('/checkout', [ShoppingCartController::class, 'checkout'])->name('checkout');
