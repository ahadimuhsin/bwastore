<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreSettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardTransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/details/{id}', [\App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::get('/success', [\App\Http\Controllers\CartController::class, 'success'])->name('success');
Route::get('register/success', [\App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('register-success');

Route::prefix('dashboard')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/products', [DashboardProductController::class, 'index'])->name('dashboard.products');
    Route::get('/products/{id}', [DashboardProductController::class, 'show'])->name('dashboard.products.details');

    Route::get('/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard.transactions');
    Route::get('/transactions/{id}', [DashboardTransactionController::class, 'show'])->name('dashboard.transactions.details');

    Route::get('store-settings', [StoreSettingsController::class, 'store'])->name('dashboard.settings');
    Route::get('accounts', [StoreSettingsController::class, 'account'])->name('dashboard.accounts');
});

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')
// ->middleware(['auth', 'is_admin'])
->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
Auth::routes();
