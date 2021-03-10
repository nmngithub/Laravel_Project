<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\TinTuc;

class LoaiTinController extends Controller
{
    public function getDanhSach(){
        $theloai = TheLoai::select('TheLoai_id','Ten')->orderBy('TheLoai_id', 'asc')->get()->toArray();
        $tl=[];
        foreach($theloai as $key => $tloai)
        {
            $tl[$tloai['TheLoai_id']] = $tloai['Ten'];
        }

        return view('admin.loaitin.danhsach',['tl'=>$tl]);
    }

    public function getThem(){
        $tl = TheLoai::all();
        return view('admin.loaitin.them',['tl'=>$tl]);
    }
    public function postThem(Request $req){ 

        $this->validate($req,
        [
            'Ten'=> 'required|unique:loaitin,Ten|min:3|max:100',
            'TheLoai_id'=>'required',
            'LoaiTin_id'=>'required|unique:loaitin,LoaiTin_id|numeric'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên loại tin!',
            'Ten.unique'=>'Tên loại tin đã tồn tại!',
            'Ten.min'=>'Tên loại tin phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên loại tin phải từ 3 đến 100 ký tự!',

            'TheLoai_id.required'=>'Bạn chưa chọn thể loại!',

            'LoaiTin_id.required'=>'Bạn chưa nhập LoaiTin_id!',
            'LoaiTin_id.unique'=>'LoaiTin_id đã tồn tại!',
            'LoaiTin_id.numberic'=>'LoaiTin_id phải là kiểu số!',
        ]);
        
        $loaitin = new LoaiTin;
        $loaitin->LoaiTin_id = $req->LoaiTin_id;
        $loaitin->TheLoai_id = $req->TheLoai_id;
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        
        
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
            'Ten'=> 'required|unique:loaitin,Ten|min:3|max:100',
            'TheLoai_id'=>'required',
            'LoaiTin_id'=>'required|unique:loaitin,LoaiTin_id|numeric'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên loại tin!',
            'Ten.unique'=>'Tên loại tin đã tồn tại!',
            'Ten.min'=>'Tên loại tin phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên loại tin phải từ 3 đến 100 ký tự!',

            'TheLoai_id.required'=>'Bạn chưa chọn thể loại!',

            'LoaiTin_id.required'=>'Bạn chưa nhập LoaiTin_id!',
            'LoaiTin_id.unique'=>'LoaiTin_id đã tồn tại!',
            'LoaiTin_id.numberic'=>'LoaiTin_id phải là kiểu số!',
        ]);

        $loaitin->LoaiTin_id = $req->LoaiTin_id;
        $loaitin->TheLoai_id = $req->TheLoai_id;
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        
        
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
