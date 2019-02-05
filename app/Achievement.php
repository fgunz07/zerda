<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $table = 'achievements';

    protected $fillable = ['user_id','name','description','year_start','year_end'];


    public function parent_user_achievement(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
