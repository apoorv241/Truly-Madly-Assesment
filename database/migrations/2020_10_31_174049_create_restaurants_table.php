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
       if(!Schema::hasTable('restaurants')){ 
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name',50);//Name of the restaurant
            $table->text('address');//Address of the restaurant
            $table->integer('capacity');//Capacity of the restaurant
           // $table->unsignedBigInteger('city_id');                           // links us to cuisine table
            //$table->foreign('city_id')->references('id')->on('cities');
            $table->string('phoneno',10);//Phone Number of the restaurant
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('restaurants')){ 
        Schema::dropIfExists('restaurants');
        }
    }
}
