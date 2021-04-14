<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestKindOfNews;
use Illuminate\Http\Request;
use App\Models\KindOfNews;
use App\Models\Category;
use App\Models\Detail;

class KindOfNewsController extends Controller
{
    public function getList(){
        $KindOfNews = KindOfNews::all()->sortByDesc('created_at');
        $Category = Category::all();
        return view('admin.kindofnews.list',['KindOfNews'=>$KindOfNews, 'Category'=>$Category]);
    }

    public function getAdd(){
        $Category = Category::select('Ten')->get();
        return view('admin.kindofnews.add',['Category'=>$Category]);
    }
    public function postAdd(RequestKindOfNews $req){ 
        $KindOfNews = new KindOfNews;

        $KindOfNews->IdTheLoai = $req->IdTheLoai;
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
    public function postEdit(RequestKindOfNews $req, $id){
        $KindOfNews = KindOfNews::find($id);
    
        $KindOfNews->IdTheLoai = $req->IdTheLoai;
        $KindOfNews->Ten = $req->Ten;
        $KindOfNews->TenKhongDau = changeTitle($req->Ten);

        $KindOfNews->save();

        return redirect()->back()->with('notification','Đã sửa Thành Công!');   
    }

    public function getDelete($id) {

    	$KindOfNews = KindOfNews::find($id);
        $Detail = Detail::where('IdLoaiTin',$id);
        $Detail->delete();
    	$KindOfNews->delete();
    	return redirect()->back()->with('notification','Đã xóa thành công!');
    }
}
