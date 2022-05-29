<?php
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
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


Route::post('daily-report', [ApiController::class,'dailyReport']);
Route::post('customers', [ApiController::class,'customers'])->name('customers');
Route::post('products', [ApiController::class,'products'])->name('products');
Route::post('services', [ApiController::class,'services'])->name('services');
Route::post('expenses', [ApiController::class,'expenses'])->name('expenses');
Route::post('bookings', [ApiController::class,'bookings'])->name('bookings');
Route::post('payments', [ApiController::class,'payments'])->name('payments');
Route::post('productsales', [ApiController::class,'productsales'])->name('productsales');
Route::post('servicesales', [ApiController::class,'servicesales'])->name('servicesales');
Route::post('purchases', [ApiController::class,'purchases'])->name('purchases');
Route::post('dashboard', [ApiController::class,'dashboard'])->name('dashboard');

Route::match(['get', 'post'],'stock-report', [ApiController::class,'stockReport'])->name('stock.reports');

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout']);
});