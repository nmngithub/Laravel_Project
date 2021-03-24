<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Slide;
use App\Models\Users;
use App\Models\Comment;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    //     $theloai = TheLoai::all();
    //     $slide = Slide::all();
    //     $loaitin = LoaiTin::all();
    //     $tintuc = TinTuc::all()->sortByDesc('created_at');
    //     $comment = Comment::all();
    //     $user = Auth::user();
    //     View::share('theloai', $theloai);
    //     View::share('slide', $slide);
    //     View::share('loaitin', $loaitin);
    //     View::share('tintuc', $tintuc);
    //     View::share('comment', $comment);
    //     if(Auth::check()){
    //         View::share('user',$user);
    //     }


    //     //Thể Loại, Loại Tin, Tin Tức liên kết
    //     $theloai = TheLoai::select('Ten')->get()->toArray();
    //     $loaitin = LoaiTin::select('TheLoai','Ten')->get()->toArray();
    //     $tintuc = TinTuc::select('TheLoai','LoaiTin','TieuDe')->get()->toArray();
    //     $lt = [];
  
    //     foreach($loaitin as $key2 => $value2)
    //     {
            
    //         $lt[$value2['TheLoai']][$value2['_id']] = $value2['Ten'];
    //     }
    //     View::share('lt', $lt);
    }
}
