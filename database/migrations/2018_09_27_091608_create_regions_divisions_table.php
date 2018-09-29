<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions_divisions', function (Blueprint $table) {
            $table->unsignedInteger('region_id');
            $table->unsignedInteger('division_id');
            $table->index(['region_id', 'division_id']);
            $table->year('year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions_divisions');
    }
}
