<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', [ProductController::class, 'index'])->name('landing');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister']);
Route::get('/dashboard', [ProductController::class, 'dashboard'])
    ->name('dashboard')
    ->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/buy/{id}', [ProductController::class, 'buyProduct'])->name('buy.product');
Route::get('/collections', [ProductController::class, 'collections'])->name('collections');
Route::get('/shop/{id}', [ProductController::class, 'showShop'])->name('shop.show');
Route::post('/order/complete', [ProductController::class, 'completeOrder'])->name('order.complete');

Route::get('/account', [UserController::class, 'myAccount'])->name('account.show');

Route::delete('/order/{id}', [ProductController::class, 'cancelOrder'])->name('order.cancel');

Route::post('/logout-delete', [UserController::class, 'logoutAndDelete'])->name('logout.delete');

Route::get('/basket', [ProductController::class, 'showBasket'])->name('basket.show');
Route::post('/basket/add/{id}', [ProductController::class, 'addToBasket'])->name('basket.add');
Route::delete('/basket/{id}', [ProductController::class, 'deleteBasket'])->name('basket.delete');

Route::get('/checkout/basket', [ProductController::class, 'checkoutFromBasket'])->name('checkout.basket');

Route::post('/buy/{id}', [ProductController::class, 'buyProduct'])->name('buy.product');
