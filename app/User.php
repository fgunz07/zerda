<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
	use Notifiable, HasRoles;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name',
		'last_name',
		'middle_name',
		'email',
		'country_id',
		'achievements_id',
		'specialization_id',
		'provider_id',
		'avatar_url',
		'password',
		'provider'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function boards() {

		return $this->belongsToMany('App\Board', 'user_board');

	}

	public function child_user_skill(){
		return $this->belongsTo('App\Skill','skill_id','id');
	}

	public function child_user_location(){
		return $this->hasMany('App\Location', 'user_id', 'id');
	}

	public function child_user_education(){
		return $this->hasMany('App\Education','user_id', 'id');
	}

	public function child_user_specilization(){
		return $this->hasMany('App\Specialization','user_id','id');
	}

	public function child_user_rating(){
		return $this->hasMany('App\Rating','user_id','id');
	}

	public function child_user_achievement(){
		return $this->hasMany('App\Achievement','user_id','id');
	}
}
