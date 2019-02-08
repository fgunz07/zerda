<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserTodo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_board', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('board_id')->unsigned();
        });

        Schema::table('user_board', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('board_id')
                ->references('id')
                ->on('boards')
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
        Schema::table('user_board', function (Blueprint $table) {
            $table->dropForeign('user_board_user_id_foreign');
            $table->dropForeign('user_board_board_id_foreign');
        });

        Schema::dropIfExists('user_board');
        
    }
}
