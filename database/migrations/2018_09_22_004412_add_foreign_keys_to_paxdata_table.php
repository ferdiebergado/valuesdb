<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPaxdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paxdatas', function (Blueprint $table) {
            $table->foreign('participant_id')->references('id')->on('participants');
            $table->foreign('jobtitle_id')->references('id')->on('jobtitles');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('division_id')->references('id')->on('divisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paxdatas', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'jobtitle_id', 'region_id', 'division_id']);
        });
    }
}
