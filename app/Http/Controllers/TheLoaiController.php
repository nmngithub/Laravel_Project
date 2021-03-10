<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
        $theloai = TheLoai::all();
        $tl = [];
        foreach($theloai as $key => $value)
        {
            $tl[$value['id']] = $value['Ten'];
        }
        return view('admin.theloai.danhsach');
    }

    public function getThem(){
        return view('admin.theloai.them');
    }

    public function postThem(Request $req){
        $this->validate($req,

        [
            'Ten'=>'required|unique:theloai,Ten|min:3|max:100',
            'TheLoai_id'=>'required|unique:theloai,TheLoai_id|numeric'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên!',
            'Ten.unique'=>'Tên thể loại đã tồn tại!',
            'Ten.min'=>'Tên phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên phải từ 3 đến 100 ký tự!',

            'TheLoai_id.required'=>'Bạn chưa nhập TheLoai_id!',
            'TheLoai_id.unique'=>'TheLoai_id đã tồn tại!',
            'TheLoai_id.numberic'=>'TheLoai_id phải là kiểu số!',
        ]);
        
        $theloai = new TheLoai;
        $theloai->Ten = $req->Ten;
        $theloai->TheLoai_id = $req->TheLoai_id;
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
            'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên',
            'Ten.unique'=>'Tên thể loại đã tồn tại',
            'Ten.min'=>'Tên phải từ 3 đến 100 ký tự',
            'Ten.max'=>'Tên phải từ 3 đến 100 ký tự'
        ]);

        $theloai->Ten = $req->Ten;
        $theloai->TenkhongDau = changeTitle($req->Ten);
        $theloai->save();

        return redirect()->back()->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect()->back()->with('thongbao', 'Đã xóa thành công');
    }
}
