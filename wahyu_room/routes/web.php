<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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


Route::get('/','LandingController@home');
Route::get('/template','LandingController@template');

Auth::routes();

Route::post('/registerz', 'CustomAuthController@register');
Route::view('/register', 'auth.register');

Route::view('/hubungi-kami', 'contact_us');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin']);
    Route::get('/user', [App\Http\Controllers\HomeController::class, 'user']);


    Route::get('/editprofile',[App\Http\Controllers\StaffController::class, 'viewUserEdit']);

    Route::post('/user/store', [App\Http\Controllers\StaffController::class, 'store']);
    Route::post('/user/update', [App\Http\Controllers\StaffController::class, 'update']);
    Route::get('/user/{id}/delete', [App\Http\Controllers\StaffController::class, 'destroy']);

    Route::prefix('room-type')->group(function () {
        $cr = "RoomTypeController";
        Route::get('create', "$cr@viewCreate");
        Route::post('store', "$cr@store");
        Route::get('{id}/edit', "$cr@viewUpdate");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::get('manage', "$cr@viewManage");
    });

    Route::prefix('facility')->group(function () {
        $cr = "FacilityController";
        Route::get('create', "$cr@viewCreate");
        Route::post('store', "$cr@store");
        Route::get('{id}/edit', "$cr@viewUpdate");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::get('manage', "$cr@viewManage");
    });


    Route::prefix('room-photos')->group(function () {
        $cr = "RoomController";
        Route::get('create', "$cr@viewCreate");
        Route::post('create', "$cr@store");
        Route::post('store', "$cr@storeRoomPhoto");
        Route::get('{id}/edit', 'MaterialController@edit');
        Route::post('update', 'MaterialController@update');
        Route::get('{id}/delete', 'RoomController@deletePhoto');
        Route::get('manage', "$cr@viewManage");
    });

    Route::prefix('room')->group(function () {
        $cr = "RoomController";
        Route::get('create', "$cr@viewCreate");
        Route::post('store', "$cr@store");
        Route::get('{id}/edit', "$cr@viewUpdate");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::get('manage', "$cr@viewManage");
        Route::get('{id}/booking', "$cr@viewBooking");
    });


    Route::prefix('booking')->group(function () {
        $cr = "BookingController";
        Route::get('create', "$cr@viewCreate");
        Route::post('store', "$cr@store");
        Route::get('mybooking', "$cr@mybooking");
        Route::get('{id}/edit', "$cr@viewUpdate");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::get('manage', "$cr@viewManage");
    });

    Route::get('/admin/user/create', [App\Http\Controllers\StaffController::class, 'viewAdminCreate']);
    Route::get('/admin/user/manage', [App\Http\Controllers\StaffController::class, 'viewAdminManage']);
    Route::get('/admin/user/{id}/edit', [App\Http\Controllers\StaffController::class, 'viewAdminEdit']);
});

Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

Route::get('mobile_raz/request-sell/{id}/edit/', "RequestSellController@viewDetail");

Route::prefix('rs')->group(function () {
    $cr = "RequestSellController";
    Route::get('create', "$cr@viewCreate");
    Route::post('store', "$cr@store");
    Route::get('{id}/edit', "$cr@viewUpdate");
    Route::get('{id}/detail', "$cr@viewDetail");
    Route::post('{id}/update', "$cr@update");
    Route::post('{id}/deleteAJAX', "$cr@deleteAJAX");
    Route::post('change-driver', "$cr@changeDriver");
    Route::post('change-staff', "$cr@changeStaff");
    Route::post('change-status', "$cr@changeStatus");
    Route::post('change-truck', "$cr@changeTruck");
    Route::post('change-major', "$cr@changeMajor");
    Route::get('manage', "$cr@viewManage");

    // for scaling
    $cr2 = "RsScaleController";
    Route::post('{id}/scale/store', "$cr2@store");
    Route::get('{id}/scale/get', "$cr2@store");
    Route::post('{id}/scale/{id_scale}/delete', "$cr2@delete");
});
