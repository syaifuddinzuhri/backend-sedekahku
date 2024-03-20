<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BankController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\MarketController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProgramController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\WilayahController;
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

Route::get('/banner', [BannerController::class, 'index'])->name('api.banner.index');
Route::get('/payment', [PaymentController::class, 'index'])->name('api.payment.index');
Route::post('/payment', [PaymentController::class, 'store'])->name('api.payment.store');
Route::get('/program', [ProgramController::class, 'index'])->name('api.program.index');
Route::get('/program/{id}', [ProgramController::class, 'show'])->name('api.program.show');
