<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class TheLoaiController extends Controller
{
    public function getList(){
        $Category = Category::all()->sortByDesc('created_at');
        return view('admin.category.list',['Category'=>$Category]);
    }

    public function getAdd(){
        return view('admin.category.add');
    }

    public function postAdd(Request $req){
        $this->validate($req,

        [
            'Ten'=>'required|unique:theloai,Ten|min:3|max:100',
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên!',
            'Ten.unique'=>'Tên thể loại đã tồn tại!',
            'Ten.min'=>'Tên phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên phải từ 3 đến 100 ký tự!',
        ]);
        
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

    public function postEdit(Request $req, $id){
        $Category = Category::find($id);
        $this->validate($req,
        [
            'Ten'=>'required|unique:theloai,Ten|min:3|max:100'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên',
            'Ten.unique'=>'Tên thể loại đã tồn tại',
            'Ten.min'=>'Tên phải từ 3 đến 100 ký tự',
            'Ten.max'=>'Tên phải từ 3 đến 100 ký tự'
        ]);

        $Category->Ten = $req->Ten;
        $Category->TenKhongDau = changeTitle($req->Ten);
        $Category->save();

        return redirect()->back()->with('notification','Đã sửa thành công!');
    }

    public function getDelete($id){
        $Category = Category::find($id);
        $Category->delete();

        return redirect()->back()->with('notification', 'Đã xóa thành công!');
    }
}
