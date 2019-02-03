<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'address';

    protected $fillable = ['user_id','street','brgy','city','province','country'];

    public function parent_user_location(){
        return $this->hasMany('App\User','user_id','id');
    }
}
