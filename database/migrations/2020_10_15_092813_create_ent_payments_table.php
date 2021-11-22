<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ent_payments', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('entertainment_id');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('user_id');
            $table->string('package_name');
            $table->string('order_id');
            $table->float('price');
            $table->string('duration');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('payment_method');
            $table->timestamps();

            $table->foreign('entertainment_id')->references('id')->on('entertainments');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ent_payments');
    }
}
