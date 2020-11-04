<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuisinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('cuisines')){ 
            Schema::create('cuisines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);//Name of the cuisine (example indian,chinese,mexican etc).
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
        if(Schema::hasTable('cuisines')){ 
        Schema::dropIfExists('cuisines');
        }
    }
}
