<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [

        'title',
        'description',
        'class_name',
        'budget',
        'end_date'

    ];

    protected $appends = ['html_code', 'html_code_accept'];

    public function users() {

        return $this->belongsToMany('App\User', 'user_board');

    }

    public function todos() {

        return $this->belongsToMany('App\Todo');

    }

    public function tags() {

        return $this->belongsToMany('App\Skill', 'board_skill');
    }

    function getHtmlCodeAttribute() {

        $skills = null;

        foreach($this->tags as $tag) {

            $skills .= "<small class='{$tag->class}'>{$tag->name}</small>&nbsp;";

        }

        $btnInvite = "<button class='btn btn-default btn-xs board-invite' data-toggle='modal' data-target='#devs-list' id='invite-board-{$this->id}'>Invite Devs</button>
            <button class='btn btn-default btn-xs select_senior_dev' data-toggle='modal' data-target='#sinior-dev' id='invite-siniordev-{$this->id}'>Senior Dev</button>";

        $btnDelete = "<button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='btn-delete-{$this->id}'>×</button>";

        $html1 = "<div class='col-sm-3'>
                    <div class='callout {$this->class_name}'>";
                        
        $html2 = "<h4><a href='/todo-app/boards/{$this->id}'>{$this->title}</a></h4>
                        <small>End Date: {$this->end_date}</small>
                        <br>
                        <small>Budget: {$this->budget}</small>
                        <br>
                        <small>Senior Developer: {$this->senior_developer}</small>
                        <br>
                        <br>
                        <p>{$this->description}</p>
                        <br/>
                        <div>{$skills}</div>
                        <br/>";
        $html3 =    "</div>
                </div>";
                        
        if(auth()->user()->hasRole('Client')) {

            $html1 .= $btnDelete;
            $html2 .= $btnInvite;

        }

        $html2 .= $html3;
        $html1 .= $html2;

        return $html1;

    }

    function getHtmlCodeAcceptAttribute() {

        $btnDelete = "<button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='btn-delete-{$this->id}'>×</button>";

        $html = "<div class='col-sm-3'>
                    <div class='callout {$this->class_name}'>
                        ";


        $html2 =            "<h4><a href='/todo-app/boards/{$this->id}'>{$this->title}</a></h4>

                        <p>{$this->description}</p>

                        <button class='btn btn-default btn-xs board-invite-accept' data-toggle='modal' data-target='#devs-list' id='invite-accept-{$this->id}'>Accept</button>
                        <button class='btn btn-default btn-xs board-invite-reject' data-toggle='modal' data-target='#devs-list' id='invite-cancel-{$this->id}'>Reject</button>
                    </div>
                </div>";

        if(auth()->user()->hasRole('Client')) {

            $html .= $btnDelete;

        }

        $html .= $html2;

        return $html;

    }
}
