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

    }

    public function getSua(){
        
    }
}
