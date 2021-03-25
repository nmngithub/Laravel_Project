<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function postAdd(Request $req){
        $this->validate($req,
        [
            'Ten'=>'required|unique:Slide,Ten|min:3|max:100',
            'NoiDung'=>'required|unique:Slide,Ten|min:3',
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên!',
            'Ten.unique'=>'Tên slide đã tồn tại!',
            'Ten.min'=>'Tên phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên phải từ 3 đến 100 ký tự!',
            'NoiDung.required'=>'Bạn chưa nhập tên!',
            'NoiDung.min'=>'Tên phải từ 3 ký tự trở lên!',
        ]);

        $slide = new Slide;
        $slide->Ten = $req->Ten;

        if($req->hasFile('Hinh')){
            $file = $req->file('Hinh');
            $format = $file->getClientOriginalExtension();
            if($format != 'jpg' && $format != 'png'){
                return redirect()->back()->with('notification','Hình ảnh phải có định dạng là jpg hoặc png!');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/slide'.$Hinh)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/slide',$Hinh);
            $slide->Hinh = $Hinh;
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

    public function postEdit(Request $req, $id){
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
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/slide'.$Hinh)){
                unlink('upload/slide/'.$slide->Hinh);
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/slide',$Hinh);

            $slide->Hinh = $Hinh;
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
