<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardTodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_todo', function (Blueprint $table) {
            $table->integer('board_id')->unsigned();
            $table->integer('todo_id')->unsigned();
        });

        Schema::table('board_todo', function (Blueprint $table) {

            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('todo_id')->references('id')->on('todos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('board_todo', function (Blueprint $table) {

            $table->dropForeign('board_todo_board_id_foreign');
            $table->dropForeign('board_todo_todo_id_foreign');

        });

        Schema::dropIfExists('board_todo');
    }
}
