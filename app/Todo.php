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

        $tasks = null;

        foreach($this->tasks as $task) {

            $tasks .= "<li class='callout {$task->class_name}' style='cursor: pointer;' id='task-list-{$task->id}'>
                            <h4>{$task->tasks}</h4>
                            <a href='#' data-toggle='modal' data-target='#devs' id='task-should-{$task->id}'>
                                <i class='glyphicon glyphicon-user' id='icon-{$task->id}'></i> {$task->developer}
                            </a> <br>
                            <input type='hidden' id='end_date' class='datepicker' name='{$task->tasks}'>
                            <label for='#end_date'>
                                <i class='glyphicon glyphicon-calendar' id='task-enddate-{$task->id}'></i> {$task->end_date}
                            </label>
                        </li>";

        }

        $el = "
        <div class='col-md-3'>
            <div class='box box-warning'>
                <div class='box-header with-border'>
                    <button class='btn btn-box-tool glyphicon glyphicon-remove remove-todo' id='todo-card-{$this->id}' style='display: inline-block;'></button>
                    <label style='margin-left: 15px;'>{$this->todos}</label>
                    <button class='btn btn-success btn-xs pull-right btn-add-task' data-toggle='modal' data-target='#new-task' id='todo-btn-{$this->id}'>
                        <i class='glyphicon glyphicon-plus'></i>
                        Task
                    </button>
                </div>
                <!-- /.box-header -->
                <div class='box-body' id='todo-list-{$this->id}'>
                    <ul style='padding: 0px;list-style: none;' class='sortable'>
                        {$tasks}
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
