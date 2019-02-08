<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $table = 'specializations';

    protected $fillable = ['user_id','name','description'];

    public function parent_user_specialization(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function sklill_desc(){
        return $this->belongsTo('App\Skill','name','id');
    }
}
