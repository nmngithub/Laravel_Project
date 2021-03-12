<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class TinTuc extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $collection = "tintuc";

    // public function loaitin(){
    //     return $this->belongsTo('App\Models\LoaiTin','idLoaiTin','id');
    // }

    // public function comment(){
    //     return $this->hasMany('App\Models\Comment','idTinTuc','id');
    // }
}
