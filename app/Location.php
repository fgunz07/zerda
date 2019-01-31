<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'address';

    protected $fillable = ['street','brgy','city','province','country'];

    public function parent_user_location(){
        return $this->hasOne('App\User','user_id','id');
    }
}
