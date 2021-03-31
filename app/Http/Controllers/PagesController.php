<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestPagesRegister;
use App\Http\Requests\RequestPagesLogin;
use App\Http\Requests\RequestEditAccount;
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

    public function about(){
        $Category = Category::all()->sortByDesc('created_at');
        $slide = Slide::all();
       
        $KindOfNews = KindOfNews::select('TheLoai','Ten')->get()->toArray();

        $KON = [];
  
        foreach($KindOfNews as $key => $value)
        {
            $KON[$value['TheLoai']][$value['_id']] = $value['Ten'];
        }
        return view('pages.about',['slide'=>$slide,'Category'=>$Category,'KON'=>$KON]);
    }
    public function contact(){
        $Category = Category::all()->sortByDesc('created_at');
        $slide = Slide::all();
       
        $KindOfNews = KindOfNews::select('TheLoai','Ten')->get()->toArray();

        $KON = [];
  
        foreach($KindOfNews as $key => $value)
        {
            $KON[$value['TheLoai']][$value['_id']] = $value['Ten'];
        }
        return view('pages.contact',['slide'=>$slide,'Category'=>$Category,'KON'=>$KON]);
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

    public function detail($id){
        $Detail = Detail::find($id);
        $tinnoibat = Detail::where('NoiBat', 1)->get()->sortByDesc('created_at')->take(3); 
        $tinlienquan = Detail::where('LoaiTin',$Detail->LoaiTin)->where('_id','<>',$id)->get()->sortByDesc('created_at')->take(3);

        //Comment, Users
        $users = Users::select('name')->get()->toArray();
        $cm = Comment::select('User_id','TinTuc_id','NoiDung','created_at')->where('TinTuc_id',$id)->get()->toArray();
        $showinfo = [];
        foreach($cm as $key1 => $value1){
            foreach($users as $key2 => $value2){
                if($value1['User_id'] == $value2['id']){
                    $value1['User_Name'] = $value2['name'];
                    $showinfo[$key1] = $value1;
                }
            }
        }
        
        return view('pages.detail', ['Detail'=>$Detail, 'tinnoibat'=>$tinnoibat, 'tinlienquan'=>$tinlienquan, 'showinfo'=>$showinfo]);
    }

    public function comment(Request $req, $id){
        $comment = New Comment;

        $user = new Users;

        if(Auth::user()->block == 1){
            return redirect()->back()->with('notification','Bạn đang bị block!');
        }
        else{
            $comment->User_id = Auth::user()->id;
            $comment->TinTuc_id = $id;
            $comment->NoiDung = $req->NoiDung;
            $comment->save();
        }

        return redirect()->back()->with('notification','Bạn đã comment!');;
    }

    public function getLogin(){
        return view('pages.login');
    }

    public function postLogin(RequestPagesLogin $req){

        if(Auth::attempt(['email'=>$req->email, 'password'=>$req->password])){
            return redirect('trangchu');
        }
        else{
            return redirect()->back()->with('notification', 'Tài khoản hoặc mật khẩu không chính xác!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

    public function getRegister(){
        return view('pages.register');
    }

    public function postRegister(RequestPagesRegister $req){
        $users = new Users;
        $users->name = $req->name;
        $users->email = $req->email;
        $users->quyen = 0;
        $users->block = 0;
        $users->password = bcrypt($req->password);

        $users->save();
        return redirect()->back()->with('notification','Đăng ký thành công!');

    }

    public function getEditAccount(){
        return view('pages.account');
    }

    public function postEditAccount(RequestEditAccount $req){
        $users = Auth::user();
        $users->name = $req->name;
        $users->password = bcrypt($req->password);

        $users->save();

        return redirect()->back()->with('notification','Thay Đổi thành công!');
    }


    public function search(Request $req){
        $Category = Category::all()->sortByDesc('created_at');
    
        $KindOfNews = KindOfNews::select('TheLoai','Ten')->get()->toArray();

        $KON = [];
  
        foreach($KindOfNews as $key => $value)
        {
            $KON[$value['TheLoai']][$value['_id']] = $value['Ten'];
        }

        $keywords = $req->keywords;
        $Detail = Detail::where('Tieude','like',"%$keywords%")->orWhere('TomTat','like',"%$keywords%")->orWhere('NoiDung','like',"%$keywords%")->paginate(5);
        
        return view('pages.search',['Detail'=>$Detail, 'Category'=>$Category, 'KON'=>$KON, 'keywords'=>$keywords]);
    }
}
