<?php

use App\Http\Controllers\Api\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('register/cek', [App\Http\Controllers\Auth\RegisterController::class, 'cekEmail'])->name('api-register-cek');
Route::get('province', [LocationController::class, 'provinsi'])->name('api-provinsi');
Route::get('cities/{id}', [LocationController::class, 'kota'])->name('api-kota');
