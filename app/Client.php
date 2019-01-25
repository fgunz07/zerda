<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
   protected $fillable = [
    'firstname',
    'lastname',
    'email',
    'country',
    'company',
    'password'
   ];

   protected $hidden = [
    'password','remember_token'
   ];

}
