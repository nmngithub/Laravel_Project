<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function getXoa($id, $TinTuc_id){
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('thongbao', 'Đã Xóa Comment Thành Công!');
    }
}
