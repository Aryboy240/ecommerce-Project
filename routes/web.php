<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
