<?php

use Illuminate\Support\Facades\Route;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Users;
use App\Models\Slide;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\LoaiTinController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SlideController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin'], function(){

    Route::group(['prefix'=>'theloai'], function(){
        Route::get('danhsach',[TheLoaiController::class, 'getDanhSach']);
        Route::get('them',[TheLoaiController::class, 'getThem']);
        Route::get('sua',[TheLoaiController::class, 'getSua']);
    });
    Route::group(['prefix'=>'loaitin'], function(){
        Route::get('danhsach',[LoaiTinController::class, 'getDanhSach']);
        Route::get('them',[LoaiTinController::class, 'getThem']);
        Route::get('sua',[LoaiTinController::class, 'getSua']);
    });
    Route::group(['prefix'=>'tintuc'], function(){
        Route::get('danhsach',[TinTucController::class, 'getDanhSach']);
        Route::get('them',[TinTucController::class, 'getThem']);
        Route::get('sua',[TinTucController::class, 'getSua']);
    });
    Route::group(['prefix'=>'users'], function(){
        Route::get('danhsach',[UsersController::class, 'getDanhSach']);
        Route::get('them',[UsersController::class, 'getThem']);
        Route::get('sua',[UsersController::class, 'getSua']);
    });
    Route::group(['prefix'=>'slide'], function(){
        Route::get('danhsach',[SlideController::class, 'getDanhSach']);
        Route::get('them',[SlideController::class, 'getThem']);
        Route::get('sua',[SlideController::class, 'getSua']);
    });

});