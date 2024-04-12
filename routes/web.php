<?php

use App\Http\Controllers\addbarangController;
use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\detailprodukController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\registercontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function(){
    return view('dashboard');
});

Route::get('/login', function(){
    return view('login');
});
Route::get('/kategori', function(){
    return view('kategori');
});
Route::get('/view/add_barang.blade', function(){
    return view('add_barang');
});
Route::post('login', [AuthController::class, 'login_member']);
Route::post('logout', [AuthController::class, 'logout_member']);
Route::get('/login', [logincontroller::class, 'login']);
Route::get('/register', [registercontroller::class, 'login']);
Route::get('/cart', [CartController::class, 'cart']);
Route::get('/cheackout', [CheckoutController::class, 'checkout']);
Route::get('/kategori', [kategoriController::class, 'kategori' ]);
Route::get('/add_barang', [addbarangController::class, 'add_barang']);
Route::get('/detailproduk', [detailprodukController::class , 'deataiproduk']);




// admin
Route::get('login', [AuthController::class, 'index']);
Route::get('adminpage', [AdminpageController::class, 'index']);
Route::get('calendar', [CalendarController::class, 'index']);
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/adminpage', [AdminpageController::class, 'index'])->name('adminpage');
