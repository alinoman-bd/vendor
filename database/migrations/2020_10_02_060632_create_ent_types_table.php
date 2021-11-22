<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ent_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ent_category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('seo_title')->nullable();
            $table->string('seo_tag')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('page_description')->nullable();
            $table->timestamps();
            $table->foreign('ent_category_id')->references('id')->on('ent_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ent_types');
    }
}
