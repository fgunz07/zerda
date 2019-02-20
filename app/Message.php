<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'message_html',
    	'message_text',
    	'subject',
    	'from',
    	'to',
    	'read'
    ];

    protected $appends  = ['email', 'created', 'message_url'];

    protected $dates    = ['deleted_at'];

    public function user() {

    	return $this->hasOne('App\User', 'id', 'from');

    }

    public function getEmailAttribute() {

    	return $this->user->email;

    }

    public function getCreatedAttribute() {

    	return $this->created_at->diffForHumans();

    }

    public function getMessageUrlAttribute() {

    	return url('/messages/inbox/'.$this->id);

    }
}
