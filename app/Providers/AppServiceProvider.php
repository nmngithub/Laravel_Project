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
        $slide = Slide::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::all();
        $user = Auth::user();
        View::share('theloai', $theloai);
        View::share('slide', $slide);
        View::share('loaitin', $loaitin);
        View::share('tintuc', $tintuc);
        if(Auth::check()){
            View::share('user',$user);
        }


        // Thể Loại, Loại Tin, Tin Tức liên kết
        $theloai = TheLoai::select('Ten')->get()->toArray();
        $loaitin = LoaiTin::select('TheLoai','Ten')->get()->toArray();
        $tintuc = TinTuc::select('TheLoai','LoaiTin','TieuDe')->get()->toArray();
        $tl = [];
        $lt = [];
        $tt = [];

        foreach($theloai as $key1 => $value1)
        {
            $tl[$key1] = $value1['Ten'];
        }

        foreach($tintuc as $key2 => $value2)
        {
            $tt[$value2['TheLoai']][$value2['LoaiTin']][$value2['_id']] = $value2['TieuDe'];
        }
        
        foreach($loaitin as $key3 => $value3)
        {
            $lt[$value3['TheLoai']][$value3['_id']] = $value3['Ten'];
        }
        View::share('lt', $lt);
        View::share('tt', $tt);
    }
}
