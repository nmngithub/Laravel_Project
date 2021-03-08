<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = "users";

    // public function comment(){
    //     return $this->hasMany('App\Models\Comment','idUser','id');
    // }
}
