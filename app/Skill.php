<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    protected $fillable = ['description'];

    protected $hidden = ['pivot'];

    public function parent_user_skill(){
    	return $this->hasMany('App\User','skill_id','id');
    }

    public function parent_skill(){
        return $this->hasMany('App\Specialization','name','id');
    }
}
