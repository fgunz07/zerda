<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->integer('avg_projects')
                    ->nullable()
                    ->after('rate');
            $table->integer('avg_skills')
                    ->nullable()
                    ->after('avg_projects');
            $table->integer('avg_user_rate')
                    ->nullable()
                    ->after('avg_skills');
            $table->integer('avg_hr')
                    ->nullable()
                    ->after('avg_user_rate');
            $table->integer('avg_ongoing')
                    ->nullable()
                    ->after('avg_hr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('avg_projects');
            $table->dropColumn('avg_skills');
            $table->dropColumn('avg_user_rate');
            $table->dropColumn('avg_hr');
            $table->dropColumn('avg_ongoing');
        });
    }
}
