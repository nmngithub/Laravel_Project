<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCategory;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\KindOfNews;
use App\Models\Detail;

class CategoryController extends Controller
{
    public function getList(){
        $Category = Category::all()->sortByDesc('created_at');
        return view('admin.category.list',['Category'=>$Category]);
    }

    public function getAdd(){
        return view('admin.category.add');
    }

    public function postAdd(RequestCategory $req){
        $Category = new Category;

        $Category->Ten = $req->Ten;
        $Category->TenKhongDau = changeTitle($req->Ten);

        $Category->save();

        return redirect()->back()->with('notification', 'Đã thêm thành công!');
    }

    public function getEdit($id){
        $Category = Category::find($id);
        return view('admin.category.edit',['Category'=>$Category]);
    }

    public function postEdit(RequestCategory $req, $id){
        $Category = Category::find($id);
     
        $Category->Ten = $req->Ten;
        $Category->TenKhongDau = changeTitle($req->Ten);
        
        $Category->save();

        return redirect()->back()->with('notification','Đã sửa thành công!');
    }

    public function getDelete($id){
        $Category = Category::find($id);

        $KindOfNews = KindOfNews::where('IdTheLoai',$id);
        $Detail = Detail::where('IdTheLoai', $id);

        $Detail->delete();
        $KindOfNews->delete();
        $Category->delete();

        return redirect()->back()->with('notification', 'Đã xóa thành công!');
    }
}
