<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    protected $fillable = ['description'];

    public function parent_user_skill(){
    	return $this->hasMany('App\User','skill_id','id');
    }
}
