<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntTypeEntertainmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ent_type_entertainment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('entertainment_id');
            $table->unsignedBigInteger('ent_type_id');
            $table->string('seo_title')->nullable();
            $table->string('seo_tag')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
            $table->foreign('entertainment_id')->references('id')->on('entertainments')->onDelete('cascade');
            $table->foreign('ent_type_id')->references('id')->on('ent_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ent_type_entertainment');
    }
}
