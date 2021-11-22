<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLakeLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lake_location', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lake_id');
            $table->unsignedBigInteger('location_id');

            $table->timestamps();

            $table->foreign('lake_id')->references('id')->on('lakes');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lake_location');
    }
}