<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('login'); // Refers to resources/views/login.blade.php
})->name('login');


Route::get('/register', function () {
    return view('register'); // Refers to resources/views/register.blade.php
})->name('register');


Route::get('/welcome', function () {
    return view('welcome'); // Refers to resources/views/welcome.blade.php
})->name('welcome');

