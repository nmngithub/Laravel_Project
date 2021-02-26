<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UsersController extends Controller
{
    public function getDanhSach(){
        $users = Users::all();
        return view('admin.users.danhsach',['users'=>$users]);
    }

    public function getThem(){
        return view('admin.users.them');
    }

    public function getSua(){
        
    }
}
