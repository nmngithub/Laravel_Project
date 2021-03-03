<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class PagesController extends Controller
{
    public function trangchu(){
        return view('pages.trangchu');
    }

    public function contact(){
        return view('pages.contact');
    }
}
