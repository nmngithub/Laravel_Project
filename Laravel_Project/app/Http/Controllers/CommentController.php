<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Users;
use App\Models\Detail;


class CommentController extends Controller
{
   public function getList(){
       $comment = Comment::all()->sortByDesc('created_at');
       $users = Users::select('name')->get()->toArray();
       $detail = Detail::select('TieuDe')->get()->toArray();
       foreach($comment as $key1 => $value1){
       
            foreach($users as $key2 => $value2){
                if($value1['User_id'] == $value2['_id']){
                    $value1['User_Name'] = $value2['name'];
                }
            }
       }

       foreach($comment as $key1 => $value1){
       
            foreach($detail as $key2 => $value2){
                if($value1['TinTuc_id'] == $value2['_id']){
                    $value1['TinTuc_TieuDe'] = $value2['TieuDe'];
                }
            }
        }
    return view('admin.comment.list',['comment'=>$comment]);
   }

    public function getDelete($id){
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('thongbao', 'Đã Xóa Comment Thành Công!');
    }
}
