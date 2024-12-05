<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

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