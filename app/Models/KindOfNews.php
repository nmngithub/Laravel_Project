<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class KindOfNews extends Model
{
    use HasFactory;
    protected $table = "loaitin";

    // public function theloai(){
    //     return $this->belongsTo('App\Models\TheLoai','idTheLoai','id');
    // }

    // public function tintuc(){
    //     return $this->hasMany('App\Models\TinTuc','idLoaiTin','id');
    // }
}
