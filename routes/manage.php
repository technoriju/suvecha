<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Manage\LoginController;

use App\Http\Controllers\Manage\DashboardController;

use App\Http\Controllers\Manage\HeadquarterController;

use App\Http\Controllers\Manage\AreaController;

use App\Http\Controllers\Manage\MedicineController;

use App\Http\Controllers\Manage\SpecializationController;

use App\Http\Controllers\Manage\EmployeeController;

use App\Http\Controllers\Manage\TabillController;


Route::group(['prefix' => '/'],function(){

    Route::get('/',[LoginController::class,'login']);

    Route::post('/',[LoginController::class,'loginValidate']);

    Route::get('/logout',[LoginController::class,'logout']);

});



Route::middleware(['user_protect_page_manage'])->group(function () {



    Route::get('/dashboard',[DashboardController::class,'dashboard']);

    Route::post('/dashboard',[DashboardController::class,'roleUpdate']);

    Route::get('/role',[DashboardController::class,'role']);

    //Route::resource('/headquarter', HeadquarterController::class);

    Route::resource('/area', AreaController::class);

    Route::resource('/medicine', MedicineController::class);

    Route::resource('/specialization', SpecializationController::class);

    Route::resource('/employee', EmployeeController::class);



    Route::group(['prefix' => '/report'], function(){

       Route::get('/',[ReportController::class,'index']);

       Route::post('/',[ReportController::class,'index']);

       Route::get('/stock',[ReportController::class,'stock']);

       Route::post('/stock',[ReportController::class,'stock']);

    });


    Route::group(['prefix' => '/headquarter'], function(){

        Route::get('/create',[HeadquarterController::class,'create']);

        Route::get('/',[HeadquarterController::class,'index']);

        Route::post('/',[HeadquarterController::class,'store']);

        Route::get('/{id}/edit',[HeadquarterController::class,'edit']);

        Route::put('/{id}',[HeadquarterController::class,'update']);

        Route::delete('/{id}',[HeadquarterController::class,'destroy']);

        Route::post('/subcat',[HeadquarterController::class,'subcat']);

        Route::get('/distance',[HeadquarterController::class,'distance']);

        Route::post('/distance',[HeadquarterController::class,'storeDistance']);

        Route::post('/distanceUpd',[HeadquarterController::class,'distanceUpd']);

    });

    Route::group(['prefix' => '/ta-bill'], function(){

        Route::get('/',[TabillController::class,'index']);
        Route::post('/',[TabillController::class,'index']);
        Route::post('/empfetch',[TabillController::class,'empfetch']);

     });


});









// Route::get('/', function () {

//     return view('workflow.login');

// });
