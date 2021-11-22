<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntertainmentImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entertainment_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('entertainment_id');
            $table->string('path');
            $table->timestamps();
            $table->foreign('entertainment_id')->references('id')->on('entertainments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entertainment_images');
    }
}
