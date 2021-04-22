<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\RequestSlide;
use Illuminate\Support\Str;
use App\Models\Slide;

class SlideController extends Controller
{
    public function getList(){
        $slide = Slide::all()->sortByDesc('created_at');
        return view('admin.slide.list',['slide'=>$slide]);
    }

    public function getAdd(){
        return view('admin.slide.add');
    }

    public function postAdd(RequestSlide $req){
        $slide = new Slide;
        $slide->Ten = $req->Ten;

        if($req->hasFile('Hinh')){
            $file = $req->file('Hinh');
            $format = $file->getClientOriginalExtension();
            if($format != 'jpg' && $format != 'png'){
                return redirect()->back()->with('notification','Hình ảnh phải có định dạng là jpg hoặc png!');
            }
            $name = $file->getClientOriginalName();
            while(file_exists('upload/slide/'.$name)){
                $name = Str::random(4)."_".$name;
            }
            $file->move('upload/slide',$name);
            $slide->Hinh = $name;
        } else{
            $slide->Hinh ="";
        }

        $slide->NoiDung = $req->NoiDung;

        if($req->has('Link'))
        $slide->link = $req->Link;
        $slide->save();

        return  redirect()->back()->with('notification', 'Đã Thêm Thành Công!');

    }

    public function getEdit($id){
        $slide = Slide::find($id);
        return view('admin.slide.edit',['slide'=>$slide]);
    }

    public function postEdit(RequestSlide $req, $id){
        $slide = Slide::find($id);
        $slide->Ten = $req->Ten;
        $slide->NoiDung = $req->NoiDung;
        $slide->link = $req->Link;

        if($req->hasFile('Hinh')){
            $file = $req->file('Hinh');
            $format = $file->getClientOriginalExtension();
            if($format != 'jpg' && $format != 'png'){
                return redirect()->back()->with('notification','Hình ảnh phải có định dạng là jpg hoặc png!');
            }
            unlink('upload/slide/'.$slide->Hinh);
            $name = $file->getClientOriginalName();
            while(file_exists('upload/slide/'.$name)){
                $name = Str::random(4)."_".$name;
            }
            $file->move('upload/slide',$name);

            $slide->Hinh = $name;
        }

        $slide->save();

        return redirect()->back()->with('notification','Đã sửa Thành Công!');

    }

    public function getDelete($id){
        $slide = Slide::find($id);
        $slide->delete();
        return redirect()->back()->with('notification','Đã xóa thành công!');
    }
}
