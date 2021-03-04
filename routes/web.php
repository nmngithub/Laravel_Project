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
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PagesController;

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

Route::get('admin/login',[UsersController::class, 'getLoginAdmin']);
Route::post('admin/login',[UsersController::class, 'postLoginAdmin']);
Route::get('admin/logout',[UsersController::class, 'getLogoutAdmin']);


Route::group(['prefix'=>'admin', 'middleware'=>'adminlogin'], function(){

    Route::group(['prefix'=>'theloai'], function(){
        Route::get('danhsach',[TheLoaiController::class, 'getDanhSach']);

        Route::get('them',[TheLoaiController::class, 'getThem']);
        Route::post('them',[TheLoaiController::class, 'postThem']);

        Route::get('sua/{id}',[TheLoaiController::class, 'getSua']);
        Route::post('sua/{id}',[TheLoaiController::class, 'postSua']);

        Route::get('xoa/{id}', [TheLoaiController::class, 'getXoa']);
    });
    Route::group(['prefix'=>'loaitin'], function(){
        Route::get('danhsach',[LoaiTinController::class, 'getDanhSach']);

        Route::get('them',[LoaiTinController::class, 'getThem']);
        Route::post('them',[LoaiTinController::class, 'postThem']);

        Route::get('sua/{id}',[LoaiTinController::class, 'getSua']);
        Route::post('sua/{id}',[LoaiTinController::class, 'postSua']);

        Route::get('xoa/{id}', [LoaiTinController::class, 'getXoa']);
    });
    Route::group(['prefix'=>'tintuc'], function(){
        Route::get('danhsach',[TinTucController::class, 'getDanhSach']);

        Route::get('them',[TinTucController::class, 'getThem']);
        Route::post('them',[TinTucController::class, 'postThem']);

        Route::get('sua/{id}',[TinTucController::class, 'getSua']);
        Route::post('sua/{id}',[TinTucController::class, 'postSua']);

        Route::get('xoa/{id}', [TinTucController::class, 'getXoa']);
    });

    Route::group(['prefix'=>'comment'],function(){
       Route::get('xoa/{id}/{idTinTuc}', [CommentController::class, 'getXoa']);
    });

    Route::group(['prefix'=>'slide'], function(){
        Route::get('danhsach',[SlideController::class, 'getDanhSach']);

        Route::get('them',[SlideController::class, 'getThem']);
        Route::post('them',[SlideController::class, 'postThem']);

        Route::get('sua/{id}',[SlideController::class, 'getSua']);
        Route::post('sua/{id}',[SlideController::class, 'postSua']);

        Route::get('xoa/{id}', [SlideController::class, 'getXoa']);
    });

    Route::group(['prefix'=>'users'], function(){
        Route::get('danhsach',[UsersController::class, 'getDanhSach']);

        Route::get('them',[UsersController::class, 'getThem']);
        Route::post('them',[UsersController::class, 'postThem']);

        Route::get('sua/{id}',[UsersController::class, 'getSua']);
        Route::post('sua/{id}',[UsersController::class, 'postSua']);

        Route::get('xoa/{id}', [UsersController::class, 'getXoa']);
    });
    

    Route::group(['prefix'=>'ajax'], function(){
        Route::get('loaitin/{idTheLoai}',[AjaxController::class, 'getLoaiTin']);
    });

});

Route::get('trangchu', [PagesController::class, 'trangchu'])->middleware('login');
Route::get('contact', [PagesController::class, 'contact'])->middleware('login');
Route::get('about', [PagesController::class, 'about'])->middleware('login');
Route::get('register', [PagesController::class, 'register'])->middleware('login');
Route::get('category/{id}/{TenKhongDau}.html', [PagesController::class, 'category'])->middleware('login');
Route::get('detail/{id}/{TieuDeKhongDau}.html', [PagesController::class, 'detail'])->middleware('login');
Route::get('login',[PagesController::class, 'getLogin']);
Route::post('login',[PagesController::class, 'postLogin']);
Route::get('logout',[PagesController::class, 'logout']);
Route::post('comment/{id}',[PagesController::class, 'comment']);
