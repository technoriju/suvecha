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
    Route::get('/logout',[LoginController::class,'logout']);
});

Route::middleware(['user_protect_page'])->group(function () {

    Route::group(['prefix' => '/dashboard'], function(){
        Route::get('/',[DashboardController::class,'dashboard']);
    });

    Route::group(['prefix' => '/product'], function(){
        Route::get('/create',[ProductController::class,'create']);
        Route::get('/',[ProductController::class,'index']);
        Route::post('/',[ProductController::class,'store']);
        Route::get('/{id}/edit',[ProductController::class,'edit']);
        Route::put('/{id}',[ProductController::class,'update']);
        Route::delete('/{id}',[ProductController::class,'destroy']);
        Route::post('/subcat',[ProductController::class,'subcat']);
    });

    Route::resource('/category', CategoryController::class);

    Route::resource('/seller', SellerController::class);

    Route::resource('/customer', CustomerController::class);

    Route::group(['prefix' => '/sales'], function(){
        Route::get('/invoice',[InvoiceController::class,'index']);
        Route::post('/fetchpriceqty',[InvoiceController::class,'fetchpriceqty']);
        Route::post('/invoice',[InvoiceController::class,'invoice']);
        Route::get('/print/{id}',[InvoiceController::class,'print']);
        Route::get('/transaction',[InvoiceController::class,'transaction']);
        Route::get('/invoice/{id}/edit',[InvoiceController::class,'edit']);
        Route::put('/invoice/{id}',[InvoiceController::class,'update']);
        Route::delete('/{id}',[InvoiceController::class,'destroy']);
    });

    Route::group(['prefix' => '/report'], function(){
       Route::get('/',[ReportController::class,'index']);
       Route::post('/',[ReportController::class,'index']);
    });
});




// Route::get('/', function () {
//     return view('welcome');
// });
