<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;

class LoaiTinController extends Controller
{
    public function getDanhSach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

    public function getThem(){

    }

    public function getSua(){
        
    }
}
