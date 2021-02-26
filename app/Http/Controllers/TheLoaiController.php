<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    public function getThem(){

    }

    public function getSua(){

    }
}
