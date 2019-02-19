<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    	'message_html',
    	'message_text',
    	'subject',
    	'from',
    	'to',
    	'read'
    ];

    protected $appends = ['email', 'created', 'message_url'];

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
