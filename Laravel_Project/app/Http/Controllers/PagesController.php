<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\KindOfNews;
use App\Models\Detail;
use App\Models\Users;
use App\Models\Comment;
use App\Models\Slide;
use Auth;

class PagesController extends Controller
{
    
    public function trangchu(){
        $Category = Category::all()->sortByDesc('created_at');
        $slide = Slide::all();
        $Detail = Detail::all()->sortByDesc('created_at');

        $KindOfNews = KindOfNews::select('TheLoai','Ten')->get()->toArray();
        $KON = [];
  
        foreach($KindOfNews as $key => $value)
        {
            
            $KON[$value['TheLoai']][$value['_id']] = $value['Ten'];
        }

        return view('pages.trangchu',['slide'=>$slide,'Category'=>$Category,'KON'=>$KON,'Detail'=>$Detail]);
    }

    public function kindofnews($Ten){
        $KindOfNews1 = KindOfNews::where('Ten',$Ten)->get();
        $Detail = Detail::where('LoaiTin',$Ten)->paginate(3);
        $Category = Category::all();
        $KindOfNews2 = KindOfNews::select('TheLoai','Ten')->get()->toArray();
        $KON = [];
  
        foreach($KindOfNews2 as $key => $value)
        {
            
            $KON[$value['TheLoai']][$value['_id']] = $value['Ten'];
        }
        return view('pages.kindofnews',['KindOfNews'=>$KindOfNews1,'Category'=>$Category,'Detail'=>$Detail,'KON'=>$KON]);
    }

    public function detail($_id){
       
        $Detail = Detail::find($_id);
        $tinnoibat = Detail::where('NoiBat', 1)->take(3)->get(); 
        $tinlienquan = Detail::where('LoaiTin',$Detail->LoaiTin)->where('_id','<>',$_id)->take(3)->get();

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
        
        return view('pages.detail', ['Detail'=>$Detail, 'tinnoibat'=>$tinnoibat, 'tinlienquan'=>$tinlienquan, 'showinfo'=>$showinfo]);
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
        $Detail = Detail::where('Tieude','like',"%$keywords%")->orWhere('TomTat','like',"%$keywords%")->orWhere('NoiDung','like',"%$keywords%")->take(30)->paginate(5);
        return view('pages.search',['Detail'=>$Detail, 'keywords'=>$keywords]);
    }

}
