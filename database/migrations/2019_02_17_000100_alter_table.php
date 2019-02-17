<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('educaction_id');

            $table->longText('primary_edication_full_details')
                    ->after('address')
                    ->nullable();

            $table->longText('secondary_edication_full_details')
                    ->after('primary_edication_full_details')
                    ->nullable();

            $table->longText('teriary_edication_full_details')
                    ->after('secondary_edication_full_details')
                    ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
