<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;
    protected $table = "theloai";
    protected $collection = "theloai";

    // public function loaitin(){
    //     return $this->hasMany('App\Models\LoaiTin', 'idTheLoai', 'id');
    // }

    // public function tintuc(){
    //     return $this->hasManyThrough('App\Models\TinTuc','App\Models\LoaiTin', 'idTheLoai','idLoaiTin','id');
    // }
}
