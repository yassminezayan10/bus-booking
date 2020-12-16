<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string("start",100);
            $table->string("end",100);
            $table->boolean('state')->default(1);
            $table->unsignedBigInteger('seat_id');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('seat_id')->references('id')->on('seats');
            $table->foreign('bus_id')->references('id')->on('buses');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('trips');
    }
}
