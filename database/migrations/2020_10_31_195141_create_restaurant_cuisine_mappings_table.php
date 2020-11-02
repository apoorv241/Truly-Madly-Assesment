<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantCuisineMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('restaurant_cuisine_mappings')){ 
        Schema::create('restaurant_cuisine_mappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cuisine_id');                           // links us to cuisine table
            $table->foreign('cuisine_id')->references('id')->on('cuisines');
            $table->unsignedBigInteger('restaurant_id');                         //links us to restaurant table
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->timestamps();
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
        if(Schema::hasTable('restaurant_cuisine_mappings')){ 
        Schema::dropIfExists('restaurant_cuisine_mappings');
        }
    }
}
