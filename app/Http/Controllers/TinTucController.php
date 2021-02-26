<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\TinTuc;

class TinTucController extends Controller
{
    public function getDanhSach(){
        $tintuc = TinTuc::all();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $req){
        $this->validate($req,
            [
                'TieuDe'=>'required|unique:TinTuc,TieuDe|min:3|max:100',
                'TheLoai'=>'required',
                'LoaiTin'=>'required'
            ],
            [
                'TieuDe.required'=>'Bạn chưa nhập Tiêu đề!',
                'TieuDe.unique'=>'Tiêu đề đã tồn tại!',
                'TieuDe.min'=>'Tiêu đề phải từ 3 đến 100 ký tự!',
                'TieuDe.max'=>'Tiêu đề phải từ 3 đến 100 ký tự!'
            ]
        );

        $tintuc = new TinTuc;
        $tintuc->TieuDe = $req->TieuDe;

    }

    public function getSua(){
        
    }
}
