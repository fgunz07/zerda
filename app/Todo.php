<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
    	'todos'
    ];

    protected $appends = ['html_code', 'task_list'];

    public function tasks() {

        return $this->belongsToMany('App\Task', 'todo_task');

    }

    public function getTaskListAttribute() {

        return $this->tasks;

    }

    public function getHtmlCodeAttribute() {

        $task = '<div style="margin: 10px;"></div>';

        foreach($this->task_list as $t) {
            $task .= "<li class='callout callout-info' style='margin-bottom: 1px' id='{$t->id}'>
                        {$t->tasks}
                      </li>";
        }

        $el = "
        <div class='col-md-3'>
            <div class='box box-warning'>
                <div class='box-header with-border'>
                    <button class='btn btn-box-tool' onclick='delete({$this->id})'>
                        <i class='glyphicon glyphicon-remove'></i>
                    </button>
                    <input type='hidden' value='{$this->id}' name='todo_id'>
                    <label style='margin-left: 15px;'>{$this->todos}</label>
                </div>
                <!-- /.box-header -->
                <div class='box-body' id='todo-{$this->id}'>
                    <ul style='padding: 0px;list-style: none;' class='sortable'>
                        {$task}
                    </ul>
    			</div>
    			<!-- /.box-body -->
    		</div>
    		<!-- /.box -->
    	</div>
    	";

        return $el;

    }

    // protected $hidden = ['task_list'];
}
