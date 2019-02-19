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
		'provider',
		'primary_edication_full_details',
		'secondary_edication_full_details',
		'teriary_edication_full_details'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	protected $appends = ['street', 'brgy', 'city', 'province', 'country'];

	public function boards() {

		return $this->belongsToMany('App\Board', 'user_board');

	}

	public function skills(){

		return $this->belongsToMany('App\Skill','user_skill');

	}

	public function achievements() {

		return $this->hasMany('App\Achievement', 'user_id', 'id');

	}

	public function getMessageFrom() {

		return $this->hasMany('App\Message', 'from', 'id');

	}

	public function getStreetAttribute() {

		if(!is_null($this->address)) {

			return explode(',', $this->address)[0];

		}

		return null;

	}

	public function getBrgyAttribute() {

		if(!is_null($this->address)) {

			return explode(',', $this->address)[1];

		}

		return null;

	}

	public function getCityAttribute() {

		if(!is_null($this->address)) {

			return explode(',', $this->address)[2];

		}

		return null;

	}

	public function getProvinceAttribute() {

		if(!is_null($this->address)) {

			return explode(',', $this->address)[3];

		}

		return null;

	}

	public function getCountryAttribute() {

		if(!is_null($this->address)) {

			return explode(',', $this->address)[4];

		}

		return null;

	}
}
