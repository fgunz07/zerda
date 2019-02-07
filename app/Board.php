<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [

        'title',
        'description',
        'class_name'

    ];

    protected $appends = ['html_code', 'html_code_accept'];

    public function users() {

        return $this->belongsTo('App\User');

    }

    public function todos() {

        return $this->belongsToMany('App\Todo');

    }

    function getHtmlCodeAttribute() {

        $html = "<div class='col-sm-3'>
                    <div class='callout {$this->class_name}'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='btn-delete-{$this->id}'>×</button>
                        <h4><a href='/todo-app/boards/{$this->id}'>{$this->title}</a></h4>

                        <p>{$this->description}</p>

                        <button class='btn btn-default btn-xs board-invite' data-toggle='modal' data-target='#devs-list' id='invite-board-{$this->id}'>Invite Devs</button>
                    </div>
                </div>";

        return $html;

    }

    function getHtmlCodeAcceptAttribute() {

        $html = "<div class='col-sm-3'>
                    <div class='callout {$this->class_name}'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='btn-delete-{$this->id}'>×</button>
                        <h4><a href='/todo-app/boards/{$this->id}'>{$this->title}</a></h4>

                        <p>{$this->description}</p>

                        <button class='btn btn-default btn-xs board-invite' data-toggle='modal' data-target='#devs-list' id='invite-accept-{$this->id}'>Accept</button>
                        <button class='btn btn-default btn-xs board-invite' data-toggle='modal' data-target='#devs-list' id='invite-cancel-{$this->id}'>Reject</button>
                    </div>
                </div>";
        
        return $html;

    }
}
