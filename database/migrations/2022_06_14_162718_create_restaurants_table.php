<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string( column: 'name');
            $table->string( column: 'address');
            $table->string( column: 'district');
            $table->string( column: 'province');
            $table->string( column: 'state');
            $table->time( column: 'open');
            $table->time( column: 'close');
            $table->text( column: 'img');
            $table->string( column: 'latitude');
            $table->string( column: 'longitude');
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
        Schema::dropIfExists('restaurants');
    }
}
