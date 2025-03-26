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
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\AdminCouponController;
use App\Http\Controllers\WallpaperController;
use App\Http\Controllers\WishlistController;

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
// Admin Order Management API Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders/data', [OrderController::class, 'getAdminOrdersData'])->name('orders.data');
    Route::get('/orders/{order}', [OrderController::class, 'adminOrderDetail'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'apiUpdateOrderStatus'])->name('orders.update-status');
    Route::post('/orders/{order}/note', [OrderController::class, 'addNote'])->name('orders.add-note');
});

Route::post('/update-personal-info', [UserController::class, 'updatePersonalInfo'])->name('update.personal.info');

// Forgot Password feature routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

/*
|--------------------------------------------------------------------------
| Admin Account Routes
|--------------------------------------------------------------------------
*/

Route::get('/adminlogin', function () {
    return view('admin/AdminLogin');
})->name('adminlogin');

Route::post('/adminlogin', [AdminController::class, 'adminLogin'])->name('adminlogin.post');

// Admin Panel Route (Ensures Admin Access)
Route::get('/adminpanel', [App\Http\Controllers\AdminController::class, 'adminPanelAccess'])->name('adminpanel');
Route::get('/adminpanel/stats', [AdminController::class, 'getStats']);
Route::get('/adminpanel/recent-activity', [AdminController::class, 'getRecentActivity']);



// Admin Orders Route (Ensures Admin Access)
Route::get('/AdminOrders', [App\Http\Controllers\AdminController::class, 'adminOrdersAccess'])->name('AdminOrders');

// Admin Profile Route (Ensures Admin Access)
Route::get('/adminprofile', [App\Http\Controllers\AdminController::class, 'adminOrdersAccess'])->name('adminprofile');

// web.php (Route for showing all users in the AdminCustomers page)
Route::get('/customers', [UserController::class, 'showCustomers'])->name('customers');


Route::get('/AdminOrders', [OrderController::class, 'adminOrders'])->name('AdminOrders');

// Route for updating a user
Route::post('/admin/users/{user}/update', [UserController::class, 'updateUser'])->name('admin.users.update');

// Route for deleting a user
Route::post('/admin/users/{user}/delete', [UserController::Class, 'deleteUser'])->name('deleteuser');

Route::get('/admin/users/{id}', [UserController::class, 'getUserInfo']);

Route::post('/admin/create-user', [AdminController::class, 'storeUser'])->name('admin.createUser');

// Report Route
Route::get('/adminreport', [App\Http\Controllers\OrderController::class, 'adminReport'])->name('adminreport');

// Product Admin Routes
Route::post('/admin/products', [ProductController::class, 'store'])->name('productadmin.store');
Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('productadmin');
Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('productadmin.update');
Route::put('/admin/products/update-stock/{id}', [ProductController::class, 'updateStock'])->name('productadmin.updateStock'); 
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('productadmin.destroy');

// REVIEW PAGE
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('admin.reviews');
    Route::put('/admin/reviews/{id}', [ReviewController::class, 'update'])->name('admin.reviews.update');
    Route::delete('/admin/reviews/{id}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
});

// Wallpapers
Route::get('/admin/wallpapers', [WallpaperController::class, 'index'])->name('wallpapers');
Route::post('/admin/change-wallpaper', [WallpaperController::class, 'changeWallpaper'])->name('change.wallpaper');


/*
|--------------------------------------------------------------------------
| Search Routes
|--------------------------------------------------------------------------
*/

Route::get('/search', [ProductController::class, 'index'])->name('search');


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
// Coupon Application Routes
Route::post('/apply-coupon', [ShoppingCartController::class, 'applyCoupon'])->name('coupon.apply');
Route::post('/remove-coupon', [ShoppingCartController::class, 'removeCoupon'])->name('coupon.remove');

});

// Login Check API
Route::get('/check-login', function () {
    return response()->json(['logged_in' => auth()->check()]);
});

// Checkout Page
Route::get('/checkout', [ShoppingCartController::class, 'checkout'])->name('checkout');

// Admin Coupon Routes
Route::prefix('admin')->group(function () {
    Route::get('/coupons', [AdminCouponController::class, 'coupons'])->name('admin.coupons');
    Route::get('/coupons/add', [AdminCouponController::class, 'add'])->name('admin.coupons.add');
    Route::post('/coupons', [AdminCouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('/coupons/{coupon}/edit', [AdminCouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::put('/coupons/{coupon}', [AdminCouponController::class, 'update'])->name('admin.coupons.update');
    Route::delete('/coupons/{coupon}', [AdminCouponController::class, 'destroy'])->name('admin.coupons.destroy');
    
});

Route::middleware(['auth'])->prefix('wishlist')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
});