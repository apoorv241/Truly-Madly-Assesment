<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('foods')){ 
                Schema::create('foods', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');//name of the dish example(rice,dal,mutton)
                $table->unsignedBigInteger('cuisine_id');
                $table->foreign('cuisine_id')->references('id')->on('cuisines');
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
        if(Schema::hasTable('foods')){ 
            Schema::dropIfExists('foods');
        }
    }
}
