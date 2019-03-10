<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRatesColumnOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->bigInteger('number_rate')
                    ->nullable()
                    ->default(0)
                    ->after('id');
            $table->integer('total_rate')
                    ->nullable()
                    ->default(0)
                    ->after('number_rate');
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
            $table->dropColumn('number_rate');
            $table->dropColumn('total_rate');
        });
    }
}
