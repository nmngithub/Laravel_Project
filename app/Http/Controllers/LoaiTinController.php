<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\TinTuc;

class LoaiTinController extends Controller
{
    public function getDanhSach(){
        $loaitin = LoaiTin::all();

        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

    public function getThem(){
        $tl = TheLoai::all();
        return view('admin.loaitin.them',['tl'=>$tl]);
    }
    public function postThem(Request $req){ 

        $this->validate($req,
        [
            'Ten'=> 'required|unique:LoaiTin,Ten|min:3|max:100',
            'TheLoai'=>'required'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên loại tin!',
            'Ten.unique'=>'Tên loại tin đã tồn tại!',
            'Ten.min'=>'Tên loại tin phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên loại tin phải từ 3 đến 100 ký tự!',
            'TheLoai.required'=>'Bạn chưa chọn thể loại!'
        ]);

        $loaitin = new LoaiTin;
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->TheLoai = $req->TheLoai;
        $loaitin->save();

        return redirect()->back()->with('thongbao','Thêm thành công!');
    }


    public function getSua($id){
        $tl = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua', ['loaitin'=>$loaitin,'tl'=>$tl]);
        
    }
    public function postSua(Request $req, $id){
        $loaitin = LoaiTin::find($id);

        $this->validate($req,
        [
            'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
            'TheLoai'=>'required'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên loại tin!',
            'Ten.unique'=>'Tên loại tin đã tồn tại!',
            'Ten.min'=>'Tên loại tin phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên loại tin phải từ 3 đến 100 ký tự!',
            'TheLoai.required'=>'Bạn chưa chọn thể loại!'
        ]);

        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->TenKhongDau);
        $loaitin->TheLoai = $req->TheLoai;
        $loaitin->save();

        return redirect()->back()->with('thongbao','Sửa Thành Công');   
    }

    public function getXoa($id) {

    	$loaitin = loaitin::find($id);
        $tintuc = tintuc::where('loaitin',$id);
        $tintuc->delete();
    	$loaitin->delete();
    	return redirect()->back()->with('thongbao','Xóa thành công');
    }
}
