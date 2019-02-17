<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratingdesc extends Model
{
    protected $table = 'ratings_desc';

    protected $fillable = ['description'];

    public function child_rate_desc(){
        return $this->hasMany('App\Rating','name','id');
    }
}
