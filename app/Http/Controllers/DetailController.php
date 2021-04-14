<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\KindOfNews;
use App\Models\Category;
use App\Models\Detail;
use App\Models\Comment;


class DetailController extends Controller
{
    public function getList(){
        $Category = Category::all();
        $KindOfNews = KindOfNews::all();
        $Detail = Detail::all()->sortByDesc('created_at');
        return view('admin.detail.list',['Category'=>$Category,'KindOfNews'=>$KindOfNews,'Detail'=>$Detail]);
    }

    public function getAdd(){
        $Category = Category::all();
        $KindOfNews = KindOfNews::all();
        return view('admin.detail.add',['Category'=>$Category,'KindOfNews'=>$KindOfNews]);
    }
    public function postAdd(RequestDetail $req){
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
            while(file_exists('upload/tintuc/'.$name)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            $Detail->Hinh = $Hinh;
        } else{
            $Detail->Hinh ="";
        }
        $Detail->NoiBat = (int)$req->NoiBat;
        $Detail->IdTheLoai = $req->IdTheLoai;
        $Detail->IdLoaiTin = $req->IdLoaiTin;
        $Detail->save();

        return redirect()->back()->with('notification','Đã thêm Thành Công!');
    }

    public function getEdit($id){
        $Category = Category::all();
        $KindOfNews = KindOfNews::all();
        $Detail = Detail::find($id);
        return view('admin.detail.edit',['Detail'=>$Detail, 'Category'=>$Category, 'KindOfNews'=>$KindOfNews]);
    }

    public function postEdit(RequestDetail $req, $id){
        $Detail = Detail::find($id);

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
            while(file_exists('upload/tintuc/'.$name)){
                unlink('upload/tintuc/'.$tintuc->name);
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            
            
            $Detail->Hinh = $Hinh;
        }
        $Detail->NoiBat = (int) $req->NoiBat;
        $Detail->IdTheLoai = $req->IdTheLoai;
        $Detail->IdLoaiTin = $req->IdLoaiTin;
        
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