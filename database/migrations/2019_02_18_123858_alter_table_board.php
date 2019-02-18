<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBoard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boards', function (Blueprint $table) {
            $table->integer('budget')
                    ->after('class_name')
                    ->nullable();

            $table->date('end_date')
                    ->after('budget')
                    ->nullable();
        });

        Schema::create('board_skill', function (Blueprint $table) {
            $table->unsignedInteger('board_id');
            $table->usignedInteger('skill_id');
        });

        Schema::table('board_skill', function (Blueprint $table) {
            $table->foreign('board_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('skill_id')
                    ->references('id')
                    ->on('skills')
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
        Schema::table('board_skill', function (Blueprint $table) {
            $table->dropForeign('board_skill_board_id_foreign');
            $table->dropForeign('board_skill_skill_id_foreign');
        });

        Schema::dropIfExists('board_skill');
    }
}
