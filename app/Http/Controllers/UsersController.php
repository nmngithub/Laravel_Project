<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Users;
use App\Models\Comment;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class UsersController extends Controller
{
    public function getDanhSach(){
        $users = Users::all();
        return view('admin.users.danhsach',['users'=>$users]);
    }

    public function getThem(){
        return view('admin.users.them');
    }
    public function postThem(Request $req){
        $this->validate($req,
        [
            'Ten'=>'required|min:3|max:100',
            'Email'=>'required|email|min:3|max:30',
            'password'=>'required|min:3|max:12',
            'passwordAgain'=>'required|same:password|min:3|max:12',
        ],
        [
            'Ten.required'=>'Bạn chưa nhập Tên người dùng!',
            'Ten.min'=>'Tên người dùng phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên người dùng phải từ 3 đến 100 ký tự!',

            'Email.required'=>'Bạn chưa nhập Email!',
            'Email.email'=>'Bạn chưa nhập đúng định dạng Email!',
            'Email.min'=>'Email phải từ 3 đến 30 ký tự!',
            'Email.max'=>'Email phải từ 3 đến 30 ký tự!',

            'password.required'=>'Bạn chưa nhập Password!',
            'password.email'=>'Bạn chưa nhập đúng định dạng Password!',
            'password.min'=>'Mật khẩu phải từ 3 đến 12 ký tự!',
            'password.max'=>'Mật khẩu phải từ 3 đến 12 ký tự!',

            'passwordAgain.required'=>'Bạn chưa nhập lại Password!',
            'passwordAgain.email'=>'Bạn chưa nhập đúng định dạng Password!',
            'passwordAgain.min'=>'Mật khẩu phải từ 3 đến 12 ký tự!',
            'passwordAgain.max'=>'Mật khẩu phải từ 3 đến 12 ký tự!',
            'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp!',
        ]);

        $users = new Users;
        $users->User_id =(int) $req->User_id;
        $users->name = $req->Ten;
        $users->email = $req->Email;
        $users->password = bcrypt($req->password); 
        $users->quyen = $req->quyen;
        $users->block = $req->block;

        $users->save();

        return redirect()->back()->with('thongbao', 'Đã thêm thành công!');
    }

    public function getSua($id){
        $users = Users::find($id);
        return view('admin/users/sua',['users'=>$users]);
    }

    public function postSua(Request $req, $id){
        $users = Users::find($id);
        
        $this->validate($req,
        [
            'Ten'=>'required|min:3|max:100',
            'Email'=>'required|email|min:3|max:30',
            'password'=>'required|min:3|max:12',
            'passwordAgain'=>'required|same:password|min:3|max:12'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập Tên người dùng!',
            'Ten.min'=>'Tên người dùng phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên người dùng phải từ 3 đến 100 ký tự!',

            'Email.required'=>'Bạn chưa nhập Email!',
            'Email.email'=>'Bạn chưa nhập đúng định dạng Email!',
            'Email.min'=>'Email phải từ 3 đến 30 ký tự!',
            'Email.max'=>'Email phải từ 3 đến 30 ký tự!',

            'password.required'=>'Bạn chưa nhập Password!',
            'password.email'=>'Bạn chưa nhập đúng định dạng Password!',
            'password.min'=>'Mật khẩu phải từ 3 đến 12 ký tự!',
            'password.max'=>'Mật khẩu phải từ 3 đến 12 ký tự!',

            'passwordAgain.required'=>'Bạn chưa nhập lại Password!',
            'passwordAgain.email'=>'Bạn chưa nhập đúng định dạng Password!',
            'passwordAgain.min'=>'Mật khẩu phải từ 3 đến 12 ký tự!',
            'passwordAgain.max'=>'Mật khẩu phải từ 3 đến 12 ký tự!',
            'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp!'
        ]);
        
        $users->name = $req->Ten;
        $users->email = $req->Email;
        $users->password = bcrypt($req->password); 
        $users->quyen = $req->quyen;
        $users->block = $req->block;

        $users->save();

        return redirect()->back()->with('thongbao', 'Đã sửa thành công!');
    }


    public function getXoa($id){
        $users = Users::find($id);
        dd($users);
        $users->delete();
        return redirect()->back()->with('thongbao', 'Đã xóa User thành công!');
    }

    public function getLoginAdmin(){
        return view('admin/login');
    }

    public function postLoginAdmin(Request $req){
        $this->validate($req,
        [
            'email'=>'required',
            'password'=>'required'
        ],
        [
            'email.required'=>'Bạn chưa nhập Email!',
            'password.required'=>'Bạn chưa nhập Password!'
        ]);

        if(Auth::attempt(['email'=>$req->email, 'password'=>$req->password])){
            return redirect('admin/theloai/danhsach');
        }
        else{
            return redirect()->back()->with('thongbao', 'Tài khoản hoặc mật khẩu không chính xác!');
        }
    }

    public function getLogoutAdmin(){
        Auth::logout();
        return redirect('admin/login');
    }
}
