<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_locations', function (Blueprint $table) {
            $table->id();
            $table->string('start_location')->comment('Start location')->nullable();
            $table->string('end_location')->comment('End location')->nullable();
            $table->double('distance', 10, 2)->comment('in km')->nullable();
            $table->double('start_latitude')->comment('start latitude')->nullable();
            $table->double('start_longitude')->comment('start longitude')->nullable();
            $table->double('end_latitude')->comment('end latitude')->nullable();
            $table->double('end_longitude')->comment('end longitude')->nullable();
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
        Schema::dropIfExists('geo_locations');
    }
}
