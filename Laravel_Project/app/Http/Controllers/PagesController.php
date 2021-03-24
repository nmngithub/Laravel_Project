<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Users;
use App\Models\Comment;
use App\Models\Slide;
use Auth;

class PagesController extends Controller
{
    
    public function trangchu(){
        $theloai = TheLoai::all()->sortByDesc('created_at');
        $slide = Slide::all();
        $tintuc = TinTuc::all()->sortByDesc('created_at');

        $loaitin = LoaiTin::select('TheLoai','Ten')->get()->toArray();
        $lt = [];
  
        foreach($loaitin as $key2 => $value2)
        {
            
            $lt[$value2['TheLoai']][$value2['_id']] = $value2['Ten'];
        }

        return view('pages.trangchu',['slide'=>$slide,'theloai'=>$theloai,'lt'=>$lt,'tintuc'=>$tintuc]);
    }

    public function contact(){
        $slide = Slide::all();
        $theloai = TheLoai::all()->sortByDesc('created_at');
        $loai = LoaiTin::select('TheLoai','Ten')->get()->toArray();
        $lt = [];
        foreach($loai as $key => $value){
            $lt[$value['TheLoai']][$value['_id']] = $value['Ten'];
        }
        return view('pages.contact',['slide'=>$slide,'theloai'=>$theloai,'lt'=>$lt]);
    }

    public function getRegister(){
        return view('pages.register');
    }

    public function postRegister(Request $req){
        $this->validate($req,
        [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:12',
            'passwordAgain'=>'required|same:password'
        ],
        [
            'name.required'=>"Bạn chưa nhập tên!",

            'email.required'=>"Bạn chưa nhập email!",
            'email.email'=>"Chưa đúng định dạng email!",
            'email.unique'=>'Email đã tồn tại!',

            'password.required'=>'Bạn chưa nhập password!',
            'password.min'=>'Mật khẩu tối thiểu 6 ký tự!',
            'password.max'=>'Mật khẩu tối đa 12 ký tự!',

            'passwordAgain.required'=>'Bạn chưa nhập xác nhận mật khẩu!',
            'passwordAgain.same'=>'Mật khẩu không khớp!'

        ]);

        $users = new Users;
        $users->name = $req->name;
        $users->email = $req->email;
        $users->quyen = 0;
        $users->block = 0;
        $users->password = bcrypt($req->password);

        $users->save();
        return redirect()->back()->with('thongbao','Đăng ký thành công!');

    }

    public function category($Ten){
        $loaitin = LoaiTin::where('Ten',$Ten)->get();
        $tintuc = TinTuc::where('LoaiTin',$Ten)->paginate(3);
        $theloai = TheLoai::all();
        $loai = LoaiTin::select('TheLoai','Ten')->get()->toArray();
        $lt = [];
  
        foreach($loai as $key2 => $value2)
        {
            
            $lt[$value2['TheLoai']][$value2['_id']] = $value2['Ten'];
        }
        return view('pages.category',['loaitin'=>$loaitin,'theloai'=>$theloai,'tintuc'=>$tintuc,'lt'=>$lt]);
    }

    public function detail($_id){
       
        $tintuc = TinTuc::find($_id);
        $tinnoibat = TinTuc::where('NoiBat', 1)->take(3)->get(); 
        $tinlienquan = TinTuc::where('LoaiTin',$tintuc->LoaiTin)->where('_id','<>',$_id)->take(3)->get();

        //Comment, Users
        $users = Users::select('name')->get()->toArray();
        $cm = Comment::select('User_id','TinTuc_id','NoiDung','created_at')->where('TinTuc_id',$_id)->get()->toArray();
        $showinfo = [];
        foreach($cm as $key1 => $value1){
            foreach($users as $key2 => $value2){
                if($value1['User_id'] == $value2['_id']){
                    $value1['User_Name'] = $value2['name'];
                    $showinfo[$key1] = $value1;
                }
            }
        }
        
        return view('pages.detail', ['tintuc'=>$tintuc, 'tinnoibat'=>$tinnoibat, 'tinlienquan'=>$tinlienquan, 'showinfo'=>$showinfo]);
    }

    public function about(){
        $slide = Slide::all();
        $theloai = TheLoai::all();
        $loai = LoaiTin::select('TheLoai','Ten')->get()->toArray();
        $lt = [];
  
        foreach($loai as $key2 => $value2)
        {
            
            $lt[$value2['TheLoai']][$value2['_id']] = $value2['Ten'];
        }
    
        return view('pages.about',['slide'=>$slide,'theloai'=>$theloai,'lt'=>$lt]);
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

    public function comment(Request $req, $_id){
        $comment = New Comment;
        $user = new Users;
        if(Auth::user()->block == 1){
            return redirect()->back()->with('thongbao','Bạn đang bị block!');
        }
        else{
            $comment->User_id = Auth::user()->id;
            $comment->TinTuc_id = $_id;
            $comment->NoiDung = $req->NoiDung;
            $comment->save();
        }
        


        return redirect()->back()->with('thongbao','Bạn đã comment!');;
    }


    public function getAccount(){
        return view('pages.account');
    }

    public function postAccount(Request $req){
        $this->validate($req,
        [
            'name'=>'required',
            'password'=>'required|min:6|max:12',
            'passwordAgain'=>'required|same:password'
        ],
        [
            'name.required'=>"Bạn chưa nhập tên!",

            'password.required'=>'Bạn chưa nhập password!',
            'password.min'=>'Mật khẩu tối thiểu 6 ký tự!',
            'password.max'=>'Mật khẩu tối đa 12 ký tự!',

            'passwordAgain.required'=>'Bạn chưa nhập xác nhận mật khẩu!',
            'passwordAgain.same'=>'Mật khẩu không khớp!'

        ]);

        $users = Auth::user();
        $users->name = $req->name;
        $users->password = bcrypt($req->password);

        $users->save();
        return redirect()->back()->with('thongbao','Thay Đổi thành công!');
    }


    public function search(Request $req){
        $keywords = $req->keywords;
        $tintuc = TinTuc::where('Tieude','like',"%$keywords%")->orWhere('TomTat','like',"%$keywords%")->orWhere('NoiDung','like',"%$keywords%")->take(30)->paginate(5);
        return view('pages.search',['tintuc'=>$tintuc, 'keywords'=>$keywords]);
    }

}
