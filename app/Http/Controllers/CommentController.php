<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Users;


class CommentController extends Controller
{
   public function getDanhSach(){
       $comment = Comment::all();
    //    $users = Users::where('_id', $comment->User_id)->get();
       dump($comment);
    //    dump($users);
    return view('admin.comment.danhsach',['comment'=>$comment]);
   }

    public function getXoa($id, $TinTuc_id){
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('thongbao', 'Đã Xóa Comment Thành Công!');
    }
}
