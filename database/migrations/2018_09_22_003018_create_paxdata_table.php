<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaxdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paxdatas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('participant_id');
            $table->unsignedInteger('jobtitle_id')->nullable();
            $table->unsignedInteger('region_id')->nullable();
            $table->unsignedInteger('division_id')->nullable();
            $table->string('station', 255);
            $table->string('landline', 75)->nullable();
            $table->string('fax', 75)->nullable();
            $table->string('mobile', 100);
            $table->string('email', 150)->nullable();
            $table->string('facebookid', 100)->nullable();
            $table->year('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paxdatas');
    }
}
