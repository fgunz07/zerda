<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $table = 'specializations';

    protected $fillable = ['name','description'];

    public function parent_user_specialization(){
        return $this->hasMany('App\User','user_id','id');
    }
}
