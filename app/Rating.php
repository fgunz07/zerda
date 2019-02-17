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
        return $this->belongsTo('App\User', 'user_id');
        
    }

    public function parent_user_rating_desc()
    {
        return $this->belongsTo('App\Ratingdesc','name' ,'id');
        
    }

    public function getRating()
    {
        return User::join('rating', 'rating.user_id', '=', 'user.id')
            ->where('user.id', $this->attributes['id'])
            ->select(DB::raw('SUM(rating.rating) / ((COUNT(rating.* * 5) / 100) as rating'))->pluck('rating');
    }
}
