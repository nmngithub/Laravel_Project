<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Slide;
use App\Models\Users;
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
        $theloai = TheLoai::all();
        $slide = Slide::all()->sortBy('id');
        $loaitin = LoaiTin::all()->sortBy('id');
        $tintuc = TinTuc::all()->sortBy('id');
        $user = Auth::user();
        View::share('theloai', $theloai);
        View::share('slide', $slide);
        View::share('loaitin', $loaitin);
        View::share('tintuc', $tintuc);
        if(Auth::check()){
            View::share('user',$user);
        }
        
    }
}
