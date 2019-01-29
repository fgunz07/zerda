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

    protected $appends = ['html_code'];

    function getHtmlCodeAttribute() {

        $html = "<div class='col-sm-3'>
                    <div class='callout {$this->class_name}'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' onclick='Sample(e)'>×</button>
                        <h4>{$this->title}</h4>

                        <p>{$this->description}</p>
                    </div>
                </div>";

        return $html;

    }
}
