<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = ['user_id','primary','secondary','tertiary'];


    public function parent_user_educ(){
        return $this->hasOne('App\User','user_id','id');
    }
}
