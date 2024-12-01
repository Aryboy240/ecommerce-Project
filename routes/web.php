<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/product', function () {
    return view('product');
})->name('product');

Route::get('/sproduct', function () {
    return view('sproduct');
})->name('sproduct');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('Register'); // Refers to resources/views/Register.blade.php
})->name('register');

Route::get('/welcome', function () {
    return view('welcome'); // Refers to resources/views/welcome.blade.php
})->name('welcome');
    