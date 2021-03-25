<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KindOfNews;
use App\Models\Category;
use App\Models\Detail;

class LoaiTinController extends Controller
{
    public function getList(){
        $KindOfNews = KindOfNews::all()->sortByDesc('created_at');
        return view('admin.kindofnews.list',['KindOfNews'=>$KindOfNews]);
    }

    public function getAdd(){
        $Category = Category::select('Ten')->get();
        return view('admin.kindofnews.add',['Category'=>$Category]);
    }
    public function postAdd(Request $req){ 
       
        $this->validate($req,
        [
            'Ten'=> 'required|unique:loaitin,Ten|min:3|max:100',
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên loại tin!',
            'Ten.unique'=>'Tên loại tin đã tồn tại!',
            'Ten.min'=>'Tên loại tin phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên loại tin phải từ 3 đến 100 ký tự!',
        ]);
        
        $KindOfNews = new KindOfNews;

        $KindOfNews->TheLoai = $req->TheLoai;
        $KindOfNews->Ten = $req->Ten;
        $KindOfNews->TenKhongDau = changeTitle($req->Ten);
        
        $KindOfNews->save();

        return redirect()->back()->with('notification','Đã thêm thành công!');
    }


    public function getEdit($id){
        $Category = Category::all();
        $KindOfNews = KindOfNews::find($id);
        return view('admin.kindofnews.edit', ['KindOfNews'=>$KindOfNews,'Category'=>$Category]);
        
    }
    public function postEdit(Request $req, $id){
        $KindOfNews = KindOfNews::find($id);

        $this->validate($req,
        [
            'Ten'=> 'required|unique:loaitin,Ten|min:3|max:100',

        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên loại tin!',
            'Ten.unique'=>'Tên loại tin đã tồn tại!',
            'Ten.min'=>'Tên loại tin phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên loại tin phải từ 3 đến 100 ký tự!',
        ]);
        
        $KindOfNews->Ten = $req->Ten;
        $KindOfNews->TenKhongDau = changeTitle($req->Ten);
        
        
        $KindOfNews->save();

        return redirect()->back()->with('notification','Đã sửa Thành Công!');   
    }

    public function getDelete($id) {

    	$KindOfNews = KindOfNews::find($id);
        $Detail = Detail::where('loaitin',$id);
        $Detail->delete();
    	$KindOfNews->delete();
    	return redirect()->back()->with('notification','Đã xóa thành công!');
    }
}
