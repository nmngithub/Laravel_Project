<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
        $theloai = TheLoai::all()->sortByDesc('created_at');
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    public function getThem(){
        return view('admin.theloai.them');
    }

    public function postThem(Request $req){
        $this->validate($req,

        [
            'Ten'=>'required|unique:theloai,Ten|min:3|max:100',
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên!',
            'Ten.unique'=>'Tên thể loại đã tồn tại!',
            'Ten.min'=>'Tên phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên phải từ 3 đến 100 ký tự!',
        ]);
        
        $theloai = new TheLoai;
        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten);
        $theloai->save();

        return redirect()->back()->with('thongbao', 'Thêm thành công!');
    }

    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua(Request $req, $id){
        $theloai = TheLoai::find($id);
        $this->validate($req,
        [
            'Ten'=>'required|unique:theloai,Ten|min:3|max:100'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên',
            'Ten.unique'=>'Tên thể loại đã tồn tại',
            'Ten.min'=>'Tên phải từ 3 đến 100 ký tự',
            'Ten.max'=>'Tên phải từ 3 đến 100 ký tự'
        ]);

        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten);
        $theloai->save();

        return redirect()->back()->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect()->back()->with('thongbao', 'Đã xóa thành công');
    }
}
