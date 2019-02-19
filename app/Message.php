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
}
