<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SellerController;

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

Route::group(['prefix' => '/'],function(){
    Route::get('/',[LoginController::class,'login']);
    Route::post('/',[LoginController::class,'loginValidate']);
});

Route::group(['prefix' => '/dashboard'], function(){
    Route::get('/',[DashboardController::class,'dashboard']);
});

Route::group(['prefix' => '/product'], function(){
    Route::get('/create',[ProductController::class,'create']);
    Route::get('/',[ProductController::class,'index']);
    Route::post('/',[ProductController::class,'store']);
    Route::get('/{id}/edit',[ProductController::class,'edit']);
    Route::put('/{id}',[ProductController::class,'update']);
    Route::post('/subcat',[ProductController::class,'subcat']);
});

Route::resource('/category', CategoryController::class);

Route::resource('/seller', SellerController::class);

// Route::get('/', function () {
//     return view('welcome');
// });
