<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\KindOfNews;
use App\Models\Category;
use App\Models\Detail;
use App\Models\Comment;


class TinTucController extends Controller
{
    public function getList(){
        $Detail = Detail::all()->sortByDesc('created_at');
        return view('admin.detail.list',['Detail'=>$Detail]);
    }

    public function getAdd(){
        $Category = Category::all();
        $KindOfNews = KindOfNews::all();
        return view('admin.detail.add',['Category'=>$Category,'KindOfNews'=>$KindOfNews]);
    }
    public function postAdd(Request $req){
        $this->validate($req,
            [
                'TheLoai'=>'required',
                'LoaiTin'=>'required',
                'TieuDe'=>'required|unique:tintuc,TieuDe|min:3|max:100',
                'TomTat'=>'required',
                'NoiDung'=>'required',
            ],
            [
                'TheLoai.required'=>'Bạn chưa chọn thể loại!',
                'LoaiTin.required'=>'Bạn chưa chọn loại tin!',
                'TieuDe.required'=>'Bạn chưa nhập Tiêu đề!',
                'TieuDe.unique'=>'Tiêu đề đã tồn tại!',
                'TieuDe.min'=>'Tiêu đề phải từ 3 đến 100 ký tự!',
                'TieuDe.max'=>'Tiêu đề phải từ 3 đến 100 ký tự!',
                'TomTat.required'=>'Bạn chưa nhập tóm tắt!',
                'NoiDung.required'=>'Bạn chưa nhập nội dung!',
            ]
        );

        $Detail = new Detail;;

        $Detail->TieuDe = $req->TieuDe;
        $Detail->TieuDeKhongDau = changeTitle($req->TieuDe);
        $Detail->TomTat = $req->TomTat;
        $Detail->NoiDung = $req->NoiDung;

        if($req->hasFile('Hinh')){
            $file = $req->file('Hinh');
            $format = $file->getClientOriginalExtension();
            if($format != 'jpg' && $format != 'png'){
                return redirect()->back()->with('notification','Hình ảnh phải có định dạng là jpg hoặc png!');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/tintuc'.$Hinh)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            $Detail->Hinh = $Hinh;
        } else{
            $Detail->Hinh ="";
        }
        $Detail->NoiBat = $req->NoiBat;
        $Detail->TheLoai = $req->TheLoai;
        $Detail->LoaiTin = $req->LoaiTin;
        $Detail->save();

        return redirect()->back()->with('notification','Đã thêm Thành Công!');
    }

    public function getEdit($id){
        $Detail = Detail::find($id);
        return view('admin.detail.edit',['Detail'=>$Detail]);
    }

    public function postEdit(Request $req, $id){
        $Detail = Detail::find($id);
        $Detail->TieuDe = $req->TieuDe;
        $Detail->TieuDeKhongDau = changeTitle($req->TieuDeKhongDau);
        $Detail->idLoaiTin = $req->LoaiTin;
        $Detail->TomTat = $req->TomTat;
        $Detail->NoiDung = $req->NoiDung;

        if($req->hasFile('Hinh')){
            $file = $req->file('Hinh');
            $format = $file->getClientOriginalExtension();
            if($format != 'jpg' && $format != 'png'){
                return redirect()->back()->with('notification','Hình ảnh phải có định dạng là jpg hoặc png!');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/tintuc'.$Hinh)){
                unlink('upload/tintuc/'.$tintuc->Hinh);
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            
            
            $Detail->Hinh = $Hinh;
        }
        $Detail->save();

        return redirect()->back()->with('notification','Đã sửa Thành Công!');

    }

    public function getDelete($id){
        $Detail = Detail::find($id);
        $comment = Comment::where('TinTuc_id', $id);
        $comment->delete();
        $Detail->delete();
        return redirect()->back()->with('notification','Đã xóa thành công!');
    }
}