<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_todo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('todo_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('user_todo', function (Blueprint $table) {
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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

        Schema::table('user_todo', function (Blueprint $table) {
            $table->dropForeign('user_todo_user_id_foreign');
            $table->dropForeign('user_todo_todo_id_foreign');
        });

        Schema::dropIfExists('user_todo');
    }
}
