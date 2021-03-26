<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
class Comment extends Model
{
    use HasFactory;

    protected $table = "comment";

    // public function tintuc(){
    //     return $this->belongsTo('App\Models\TinTuc','idTinTuc','id');
    // }

    // public  function users(){
    //     return $this->belongsTo('App\Models\Users','idUser','id');
    // }
}
