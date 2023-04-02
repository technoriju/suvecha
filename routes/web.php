<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HeadquarterController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\StockistController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\MyprofileController;
use App\Http\Controllers\TaBillController;


Route::group(['prefix' => '/'],function(){
    Route::get('/',[LoginController::class,'login']);
    Route::post('/',[LoginController::class,'loginValidate']);
    Route::get('/logout',[LoginController::class,'logout']);
});

Route::middleware(['user_protect_page'])->group(function () {

    Route::get('/home',[IndexController::class,'index']);
    Route::resource('/headquarter', HeadquarterController::class);
    Route::resource('/area', AreaController::class);
    Route::resource('/tour', TourController::class);
    Route::resource('/leave', LeaveController::class);
    Route::resource('/my-profile', MyprofileController::class);


    Route::group(['prefix' => '/doctor-pharmacy'], function(){
        Route::get('/',[DoctorController::class,'doctorPharmacy']);
     });

     Route::group(['prefix' => '/ta-bill'], function(){
        Route::get('/',[TaBillController::class,'index']);
        Route::post('/',[TaBillController::class,'store']);
        Route::get('/list',[TaBillController::class,'list']);
        Route::post('/areaTa',[TaBillController::class,'fetchArea']);
     });

    Route::group(['prefix' => '/doctor'], function(){
        Route::get('/',[DoctorController::class,'index']);
        Route::get('/create',[DoctorController::class,'create']);
        Route::post('/',[DoctorController::class,'store']);
        Route::get('/activityList',[DoctorController::class,'indexActivity']);
        Route::get('/activity',[DoctorController::class,'activity']);
        Route::post('/activity',[DoctorController::class,'activityUpdate']);
        Route::post('/fetchArea',[DoctorController::class,'fetchArea']);
        Route::post('/fetchDoctor',[DoctorController::class,'fetchDoctor']);
        Route::post('/fetchDoctorInfo',[DoctorController::class,'fetchDoctorInfo']);
     });

    Route::group(['prefix' => '/pharmacy'], function(){
        Route::get('/',[PharmacyController::class,'index']);
        Route::get('/create',[PharmacyController::class,'create']);
        Route::post('/',[PharmacyController::class,'store']);
        Route::get('/activityList',[PharmacyController::class,'indexActivity']);
        Route::get('/activity',[PharmacyController::class,'activity']);
        Route::post('/activity',[PharmacyController::class,'activityUpdate']);
        Route::post('/fetchPharmacy',[PharmacyController::class,'fetchPharmacy']);
        Route::post('/fetchPharmacyInfo',[PharmacyController::class,'fetchPharmacyInfo']);
     });

     Route::group(['prefix' => '/stockist'], function(){
        Route::get('/',[StockistController::class,'index']);
        Route::get('/create',[StockistController::class,'create']);
        Route::post('/',[StockistController::class,'store']);
        Route::get('/activityList',[StockistController::class,'indexActivity']);
        Route::get('/activity',[StockistController::class,'activity']);
        Route::post('/activity',[StockistController::class,'activityUpdate']);
        Route::post('/fetchStockist',[StockistController::class,'fetchStockist']);
        Route::post('/fetchStockistInfo',[StockistController::class,'fetchStockistInfo']);
     });
});

// Route::group(['prefix' => '/headquarter'], function(){
    //     Route::get('/create',[HeadquarterController::class,'create']);
    //     Route::get('/',[HeadquarterController::class,'index']);
    //     Route::post('/',[HeadquarterController::class,'store']);
    //     Route::get('/{id}/edit',[HeadquarterController::class,'edit']);
    //     Route::put('/{id}',[HeadquarterController::class,'update']);
    //     Route::delete('/{id}',[HeadquarterController::class,'destroy']);
    //     Route::post('/subcat',[HeadquarterController::class,'subcat']);
    // });


// Route::get('/', function () {
//     return view('workflow.login');
// });
