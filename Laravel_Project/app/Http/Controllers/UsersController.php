<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Comment;

class UsersController extends Controller
{
    public function getList(){
        $users = Users::all()->sortByDesc('created_at');
        return view('admin.account.list',['users'=>$users]);
    }

    public function getAdd(){
        return view('admin.account.add');
    }
    public function postAdd(Request $req){
        $this->validate($req,
        [
            'Ten'=>'required|min:3|max:100',
            'Email'=>'required|email|min:6|max:30',
            'password'=>'required|min:6|max:12',
            'passwordAgain'=>'required|same:password|min:6|max:12',
        ],
        [
            'Ten.required'=>'Bạn chưa nhập Tên người dùng!',
            'Ten.min'=>'Tên người dùng phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên người dùng phải từ 3 đến 100 ký tự!',

            'Email.required'=>'Bạn chưa nhập Email!',
            'Email.email'=>'Bạn chưa nhập đúng định dạng Email!',
            'Email.min'=>'Email phải từ 6 đến 30 ký tự!',
            'Email.max'=>'Email phải từ 6 đến 30 ký tự!',

            'password.required'=>'Bạn chưa nhập Password!',
            'password.email'=>'Bạn chưa nhập đúng định dạng Password!',
            'password.min'=>'Mật khẩu phải từ 6 đến 12 ký tự!',
            'password.max'=>'Mật khẩu phải từ 6 đến 12 ký tự!',

            'passwordAgain.required'=>'Bạn chưa nhập lại Password!',
            'passwordAgain.email'=>'Bạn chưa nhập đúng định dạng Password!',
            'passwordAgain.min'=>'Mật khẩu phải từ 6 đến 12 ký tự!',
            'passwordAgain.max'=>'Mật khẩu phải từ 6 đến 12 ký tự!',
            'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp!',
        ]);

        $users = new Users;
        $users->name = $req->Ten;
        $users->email = $req->Email;
        $users->quyen = $req->quyen;
        $users->block = $req->block;
        $users->password = bcrypt($req->password); 

        $users->save();

        return redirect()->back()->with('notification', 'Đã thêm thành công!');
    }

    public function getEdit($id){
        $users = Users::find($id);
        return view('admin.account.edit',['users'=>$users]);
    }

    public function postEdit(Request $req, $id){
        $users = Users::find($id);
        
        $this->validate($req,
        [
            'Ten'=>'required|min:3|max:100',
            'Email'=>'required|email|min:6|max:30',
            'password'=>'required|min:6|max:12',
            'passwordAgain'=>'required|same:password|min:6|max:12'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập Tên người dùng!',
            'Ten.min'=>'Tên người dùng phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên người dùng phải từ 3 đến 100 ký tự!',

            'Email.required'=>'Bạn chưa nhập Email!',
            'Email.email'=>'Bạn chưa nhập đúng định dạng Email!',
            'Email.min'=>'Email phải từ 6 đến 30 ký tự!',
            'Email.max'=>'Email phải từ 6 đến 30 ký tự!',

            'password.required'=>'Bạn chưa nhập Password!',
            'password.email'=>'Bạn chưa nhập đúng định dạng Password!',
            'password.min'=>'Mật khẩu phải từ 6 đến 12 ký tự!',
            'password.max'=>'Mật khẩu phải từ 6 đến 12 ký tự!',

            'passwordAgain.required'=>'Bạn chưa nhập lại Password!',
            'passwordAgain.email'=>'Bạn chưa nhập đúng định dạng Password!',
            'passwordAgain.min'=>'Mật khẩu phải từ 6 đến 12 ký tự!',
            'passwordAgain.max'=>'Mật khẩu phải từ 6 đến 12 ký tự!',
            'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp!'
        ]);
        
        $users->name = $req->Ten;
        $users->email = $req->Email;
        $users->password = bcrypt($req->password); 
        $users->quyen = $req->quyen;
        $users->block = $req->block;

        $users->save();

        return redirect()->back()->with('notification', 'Đã sửa thành công!');
    }


    public function getDelete($id){
        $users = Users::find($id);
        $comment = Comment::where('User_id', $id);
        $comment->delete();
        $users->delete();
        return redirect()->back()->with('notification', 'Đã xóa User thành công!');
    }

    public function getLoginAdmin(){
        return view('admin.login');
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

        echo $req->email;
        echo $req->password;
        
        if(Auth::attempt(['email'=>$req->email, 'password'=>$req->password])){
            return redirect('admin/category/list');
        }
        else{
            return redirect()->back()->with('notification', 'Tài khoản hoặc mật khẩu không chính xác!');
        }
    }

    public function getLogoutAdmin(){
        Auth::logout();
        return redirect('admin/login');
    }
}
