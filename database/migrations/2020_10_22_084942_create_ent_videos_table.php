<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ent_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('entertainment_id');
            $table->string('video');
            $table->string('video_thumb');
            $table->unsignedBigInteger('video_status');
            $table->timestamps();

            $table->foreign('entertainment_id')->references('id')->on('entertainments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ent_videos');
    }
}
