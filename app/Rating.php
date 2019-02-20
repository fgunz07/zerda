<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Facades\Support\DB;
use App\User;

class Rating extends Model
{
    protected $table = 'rating';

    protected $fillable = ['user_id','rating'];

    public function parent_user_rating()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
        
    }

    public function parent_user_rating_desc()
    {
        return $this->belongsTo('App\Ratingdesc','name' ,'id');
        
    }

}
