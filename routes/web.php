<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('Login'); // Refers to resources/views/Login.blade.php
})->name('login');


Route::get('/register', function () {
    return view('register'); // Refers to resources/views/register.blade.php
})->name('register');


Route::post('/register', [UserController::class, 'register']);

Route::get('/welcome', function () {
    return view('welcome'); // Refers to resources/views/welcome.blade.php
})->name('welcome');

Route::get('/contact', function () {
    return view('Contact'); // Refers to resources/views/contact.blade.php
})->name('contact');

