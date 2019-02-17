<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_skill', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('skill_id');
        });

        Schema::table('user_skill', function (Blueprint $table) {

            $table->foreign('user_id')
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

        Schema::table('user_skill', function (Blueprint $table) {

            $table->dropForeign('user_skill_user_id_foreign');

            $table->dropForeign('user_skill_skill_id_foreign');
            
        });

        Schema::dropIfExists('user_skill');
    }
}
