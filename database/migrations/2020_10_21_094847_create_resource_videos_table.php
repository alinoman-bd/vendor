<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resource_id');
            $table->string('video');
            $table->string('video_thumb');
            $table->unsignedBigInteger('video_status');
            $table->timestamps();

            $table->foreign('resource_id')->references('id')->on('resources');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_videos');
    }
}
