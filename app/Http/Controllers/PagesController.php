<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Users;
use App\Models\Comment;
use Auth;

class PagesController extends Controller
{
    public function trangchu(){
        return view('pages.trangchu');
    }

    public function contact(){
        return view('pages.contact');
    }

    public function register(){
        return view('pages.register');
    }

    public function category($Ten){
        $loaitin = LoaiTin::where('Ten',$Ten)->get();
        $tintuc = TinTuc::where('LoaiTin',$Ten)->paginate(3);
        return view('pages.category',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    public function detail($_id){
       
        $tintuc = TinTuc::find($_id);
        $tinnoibat = TinTuc::where('NoiBat', 1)->take(3)->get(); 
        $tinlienquan = TinTuc::where('LoaiTin',$tintuc->LoaiTin)->where('_id','<>',$_id)->take(3)->get();
        return view('pages.detail', ['tintuc'=>$tintuc, 'tinnoibat'=>$tinnoibat, 'tinlienquan'=>$tinlienquan]);
    }

    public function about(){
        return view('pages.about');
    }

    public function getLogin(){
        return view('pages.login');
    }

    public function postLogin(Request $req){
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
            return redirect('trangchu');
        }
        else{
            return redirect()->back()->with('thongbao', 'Tài khoản hoặc mật khẩu không chính xác!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

    public function comment(Request $req, $id){
        $comment = New Comment;
        $user = new Users;
        $comment->idUser = Auth::user()->id;
        $comment->idTinTuc = $id;
        $comment->NoiDung = $req->NoiDung;

        $comment->save();

        return redirect()->back();
    }
}
