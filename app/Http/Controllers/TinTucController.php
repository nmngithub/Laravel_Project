<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\TinTuc;


class TinTucController extends Controller
{
    public function getDanhSach(){
        $tintuc = TinTuc::all();
        $loai = LoaiTin::all();
        $loaitin = LoaiTin::select('LoaiTin_id','TheLoai_id','Ten')->get()->toArray();
        $theloai = TheLoai::select('TheLoai_id','Ten')->get()->toArray();;
        $lt=[];
        $tl=[]; 

        foreach($theloai as $key2 => $value2)
        {
            $tl[$value2['TheLoai_id']] = $value2['Ten'];  
        }
        
        foreach($loaitin as $key1 => $value1)
        {
            $lt[$value1['LoaiTin_id']] = $value1; 
            $lt[$value1['LoaiTin_id']]['Theloai_ten'] = $tl[$value1['TheLoai_id']]; 
        }
           

        return view('admin.tintuc.danhsach',['lt'=>$lt, 'tl'=>$tl]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $req){
        $this->validate($req,
            [
                'LoaiTin'=>'required',
                'TieuDe'=>'required|unique:TinTuc,TieuDe|min:3|max:100',
                'TomTat'=>'required',
                'NoiDung'=>'required'
            ],
            [
                'LoaiTin.required'=>'Bạn chưa chọn loại tin!',
                'TieuDe.required'=>'Bạn chưa nhập Tiêu đề!',
                'TieuDe.unique'=>'Tiêu đề đã tồn tại!',
                'TieuDe.min'=>'Tiêu đề phải từ 3 đến 100 ký tự!',
                'TieuDe.max'=>'Tiêu đề phải từ 3 đến 100 ký tự!',
                'TomTat.required'=>'Bạn chưa nhập tóm tắt!',
                'NoiDung.required'=>'Bạn chưa nhập nội dung!'
            ]
        );

        $tintuc = new TinTuc;
        $tintuc->TieuDe = $req->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($req->TieuDeKhongDau);
        $tintuc->idLoaiTin = $req->LoaiTin;
        $tintuc->TomTat = $req->TomTat;
        $tintuc->NoiDung = $req->NoiDung;

        if($req->hasFile('Hinh')){
            $file = $req->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png'){
                return redirect()->back()->with('thongbao','Hình ảnh phải có đuôi là jpg hoặc png!');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/tintuc'.$Hinh)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            $tintuc->Hinh = $Hinh;
        } else{
            $tintuc->Hinh ="";
        }
        $tintuc->save();

        return redirect()->back()->with('thongbao','Thêm Thành Công!');
    }

    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view('admin/tintuc/sua',['theloai'=>$theloai, 'loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }

    public function postSua(Request $req, $id){
        $tintuc = TinTuc::find($id);
        $tintuc->TieuDe = $req->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($req->TieuDeKhongDau);
        $tintuc->idLoaiTin = $req->LoaiTin;
        $tintuc->TomTat = $req->TomTat;
        $tintuc->NoiDung = $req->NoiDung;

        if($req->hasFile('Hinh')){
            $file = $req->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png'){
                return redirect()->back()->with('thongbao','Hình ảnh phải có đuôi là jpg hoặc png!');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/tintuc'.$Hinh)){
                unlink('upload/tintuc/'.$tintuc->Hinh);
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            
            
            $tintuc->Hinh = $Hinh;
        }
        $tintuc->save();

        return redirect()->back()->with('thongbao','Sửa Thành Công!');

    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công!');
    }
}