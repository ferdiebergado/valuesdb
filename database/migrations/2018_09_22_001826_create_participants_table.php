<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('title', ['Mr.', 'Ms.', 'Mrs.', 'Dr.', 'Prof.'])->nullable();
            $table->string('firstname', 75);
            $table->string('middlename', 75)->nullable();
            $table->string('lastname', 75);
            $table->dateTime('birthday')->nullable();
            $table->enum('gender', ['M', 'F', 'O']);
            $table->unsignedInteger('jobtitle_id')->nullable();
            $table->unsignedInteger('region_id')->nullable();
            $table->unsignedInteger('division_id')->nullable();
            $table->string('station', 255);
            $table->string('landline', 75)->nullable();
            $table->string('fax', 75)->nullable();
            $table->string('mobile', 100);
            $table->string('email', 150)->nullable();
            $table->string('facebookid', 100)->nullable();
            $table->integer('yearsAsTeacher')->nullable();
            $table->integer('yearsAsSupervisor')->nullable();
            $table->integer('yearsAsCoordinator')->nullable();
            $table->string('photo', 64)->nullable();
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
        Schema::dropIfExists('participants');
    }
}
