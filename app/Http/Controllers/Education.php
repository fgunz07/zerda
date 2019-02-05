<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Education extends Controller
{
    protected $table = 'education';

    protected $fillable = ['course','primary','secondary','tertiary'];

    public function parent_user_skill(){
        return $this->hasMany('App\User','user_id','id');
    }
}
