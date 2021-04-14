<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\KindOfNews;
use App\Models\Detail;
use App\Models\Users;
use App\Models\Slide;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KindOfNewsController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SlideController;
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

Route::group(['prefix'=>'admin'], function(){

    Route::group(['prefix'=>'category'], function(){
        Route::get('list',[CategoryController::class, 'getList']);

        Route::get('add',[CategoryController::class, 'getAdd']);
        Route::post('add',[CategoryController::class, 'postAdd']);

        Route::get('edit/{id}',[CategoryController::class, 'getEdit']);
        Route::post('edit/{id}',[CategoryController::class, 'postEdit']);

        Route::get('delete/{id}', [CategoryController::class, 'getDelete']);
    });

    Route::group(['prefix'=>'kindofnews'], function(){
        Route::get('list',[KindOfNewsController::class, 'getList']);

        Route::get('add',[KindOfNewsController::class, 'getAdd']);
        Route::post('add',[KindOfNewsController::class, 'postAdd']);

        Route::get('edit/{id}',[KindOfNewsController::class, 'getEdit']);
        Route::post('edit/{id}',[KindOfNewsController::class, 'postEdit']);

        Route::get('delete/{id}', [KindOfNewsController::class, 'getDelete']);
    });

    Route::group(['prefix'=>'detail'], function(){
        Route::get('list',[DetailController::class, 'getList']);

        Route::get('add',[DetailController::class, 'getAdd']);
        Route::post('add',[DetailController::class, 'postAdd']);

        Route::get('edit/{id}',[DetailController::class, 'getEdit']);
        Route::post('edit/{id}',[DetailController::class, 'postEdit']);

        Route::get('delete/{id}', [DetailController::class, 'getDelete']);
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

Route::get('login',[PagesController::class, 'getLogin']);
Route::post('login',[PagesController::class, 'postLogin']);

Route::get('register', [PagesController::class, 'getRegister']);
Route::post('register', [PagesController::class, 'postRegister']); 

Route::group(['middleware'=>'login'], function(){
    Route::get('trangchu', [PagesController::class, 'trangchu']);

    Route::get('about', [PagesController::class, 'about']);
    
    Route::get('contact', [PagesController::class, 'contact']);

    Route::get('kindofnews/{Ten}', [PagesController::class, 'kindofnews']);

    Route::get('detail/{id}', [PagesController::class, 'detail']);

    Route::post('comment/{id}',[PagesController::class, 'comment']);

    Route::get('account',[PagesController::class, 'getEditAccount']);
    Route::post('account',[PagesController::class, 'postEditAccount']);

    Route::get('search',[PagesController::class, 'search']);
});


Route::get('logout',[PagesController::class, 'logout']);



