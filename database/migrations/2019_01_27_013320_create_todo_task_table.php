<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_task', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->unsigned();
            $table->integer('todo_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('todo_task', function (Blueprint $table) {
            $table->foreign('task_id')
                    ->references('id')
                    ->on('tasks')
                    ->onDelete('cascade');
            $table->foreign('todo_id')
                    ->references('id')
                    ->on('todos')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todo_task', function (Blueprint $table) {
            $table->dropForeign('todo_task_task_id_foreign');
            $table->dropForeign('todo_task_todo_id_foreign');
        });

        Schema::dropIfExists('todo_task');
    }
}
