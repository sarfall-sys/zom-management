<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

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
/*

 */

Route::middleware(['auth:sanctum'])->group(function () {
    // Public (but authenticated)  API
    Route::apiResource('/brands', \App\Http\Controllers\BrandController::class);
    Route::apiResource('/products', \App\Http\Controllers\ProductController::class);

    Route::get('/user', [\App\Http\Controllers\Auth\AuthController::class, 'me']);
    Route::get('/brand-names', [\App\Http\Controllers\BrandController::class, 'getBrandNames']);
    Route::get('/countries', [\App\Http\Controllers\BrandController::class, 'getCountry']);
    Route::get('/subfamily-names', [\App\Http\Controllers\SubfamilyController::class, 'getSubfamilyNames']);
    // Admin only API
    Route::middleware('can:access-admin')->prefix('admin')->group(function () {
        Route::get('/users/stats', [DashboardController::class, 'userStats']);
        Route::get('/dashboard', [\App\Http\Controllers\Auth\AuthController::class, 'adminDashboard']);
        Route::apiResource('/users', AdminController::class);
        Route::get('/roles/names', [AdminController::class, 'getRoles']);
        Route::get('/products/stats', [DashboardController::class, 'productStats']);
        Route::get('/products/brand/chart',[DashboardController::class ,'productsPerBrand']);
        Route::get('/products/subfamily/chart',[DashboardController::class ,'productsPerSubfamily']);

    });

});
