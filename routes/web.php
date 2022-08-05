<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreSettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CheckoutController;
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
Route::get('/categories/{slug}', [\App\Http\Controllers\CategoryController::class, 'detail'])->name('categories.detail');
Route::get('/details/{id}', [\App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [\App\Http\Controllers\DetailController::class, 'addToCart'])->name('add-to-cart');
Route::get('register/success', [\App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('register-success');
Route::get('/success', [\App\Http\Controllers\CartController::class, 'success'])->name('success');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::delete('cart/{id}', [\App\Http\Controllers\CartController::class, 'delete'])->name('cart.delete');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');
    Route::post ('checkout/callback', [CheckoutController::class, 'callback'])->name('callback');

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/products', [DashboardProductController::class, 'index'])->name('dashboard.products');
        Route::get('/products/create', [DashboardProductController::class, 'create'])->name('dashboard.products.create');
        Route::post('/products', [DashboardProductController::class, 'store'])->name('dashboard.products.store');
        Route::get('/products/{id}', [DashboardProductController::class, 'show'])->name('dashboard.products.details');
        Route::put('/products/{id}', [DashboardProductController::class, 'update'])->name('dashboard.products.update');
        Route::post('/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])->name('dashboard.products.upload-gallery');
        Route::get('/products/galery/delete/{id}', [DashboardProductController::class, 'deleteGallery'])->name('dashboard.products.delete-gallery');

        Route::get('/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard.transactions');
        Route::get('/transactions/{id}', [DashboardTransactionController::class, 'show'])->name('dashboard.transactions.details');
        Route::put('/transaction/update/{id}', [DashboardTransactionController::class, 'updateResi'])->name('dashboard.transactions.update');

        Route::get('store-settings', [StoreSettingsController::class, 'store'])->name('dashboard.settings');
        Route::get('accounts', [StoreSettingsController::class, 'account'])->name('dashboard.accounts');
        Route::post('accounts/{redirect}', [StoreSettingsController::class, 'update'])->name('dashboard.redirect');
    });
});
Route::prefix('admin')->namespace('App\Http\Controllers\Admin')
->middleware(['auth', 'is_admin'])
->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('product-galleries', ProductGalleryController::class);
    Route::resource('transaction', TransactionController::class);
});
Auth::routes();
