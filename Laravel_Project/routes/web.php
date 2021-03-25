<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\KindOfNews;
use App\Models\Detail;
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

    Route::group(['prefix'=>'category'], function(){
        Route::get('list',[TheLoaiController::class, 'getList']);

        Route::get('add',[TheLoaiController::class, 'getAdd']);
        Route::post('add',[TheLoaiController::class, 'postAdd']);

        Route::get('edit/{id}',[TheLoaiController::class, 'getEdit']);
        Route::post('edit/{id}',[TheLoaiController::class, 'postEdit']);

        Route::get('delete/{id}', [TheLoaiController::class, 'getDelete']);
    });
    Route::group(['prefix'=>'kindofnews'], function(){
        Route::get('list',[LoaiTinController::class, 'getList']);

        Route::get('add',[LoaiTinController::class, 'getAdd']);
        Route::post('add',[LoaiTinController::class, 'postAdd']);

        Route::get('edit/{id}',[LoaiTinController::class, 'getEdit']);
        Route::post('edit/{id}',[LoaiTinController::class, 'postEdit']);

        Route::get('delete/{id}', [LoaiTinController::class, 'getDelete']);
    });
    Route::group(['prefix'=>'detail'], function(){
        Route::get('list',[TinTucController::class, 'getList']);

        Route::get('add',[TinTucController::class, 'getAdd']);
        Route::post('add',[TinTucController::class, 'postAdd']);

        Route::get('edit/{id}',[TinTucController::class, 'getEdit']);
        Route::post('edit/{id}',[TinTucController::class, 'postEdit']);

        Route::get('delete/{id}', [TinTucController::class, 'getDelete']);
    });

    Route::group(['prefix'=>'comment'],function(){
        Route::get('list',[CommentController::class, 'getList']);
        Route::get('delete/{id}', [CommentController::class, 'getDelete']);
    });

    Route::group(['prefix'=>'slide'], function(){
        Route::get('list',[SlideController::class, 'getList']);

        Route::get('add',[SlideController::class, 'getAdd']);
        Route::post('add',[SlideController::class, 'postAdd']);

        Route::get('edit/{id}',[SlideController::class, 'getEdit']);
        Route::post('edit/{id}',[SlideController::class, 'postEdit']);

        Route::get('delete/{id}', [SlideController::class, 'getDelete']);
    });

    Route::group(['prefix'=>'account'], function(){
        Route::get('list',[UsersController::class, 'getList']);

        Route::get('add',[UsersController::class, 'getAdd']);
        Route::post('add',[UsersController::class, 'postAdd']);

        Route::get('edit/{id}',[UsersController::class, 'getEdit']);
        Route::post('edit/{id}',[UsersController::class, 'postEdit']);

        Route::get('delete/{id}', [UsersController::class, 'getDelete']);
    });
    

});

Route::get('trangchu', [PagesController::class, 'trangchu'])->middleware('login');
Route::get('contact', [PagesController::class, 'contact'])->middleware('login');
Route::get('about', [PagesController::class, 'about'])->middleware('login');
Route::get('register', [PagesController::class, 'getRegister']);
Route::post('register', [PagesController::class, 'postRegister']);  
Route::get('kindofnews/{Ten}', [PagesController::class, 'kindofnews'])->middleware('login');
Route::get('detail/{_id}', [PagesController::class, 'detail'])->middleware('login');
Route::get('login',[PagesController::class, 'getLogin']);
Route::post('login',[PagesController::class, 'postLogin']);
Route::get('logout',[PagesController::class, 'logout']);
Route::post('comment/{_id}',[PagesController::class, 'comment'])->middleware('login');
Route::get('account',[PagesController::class, 'getAccount'])->middleware('login');
Route::post('account',[PagesController::class, 'postAccount']);
Route::get('search',[PagesController::class, 'search']);

