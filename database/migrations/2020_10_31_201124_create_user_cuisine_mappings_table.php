<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCuisineMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('user_cuisine_mappings')){ 
        Schema::create('user_cuisine_mappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('cuisine_id');                           // links us to cuisine table
            $table->foreign('cuisine_id')->references('id')->on('cuisines');
            $table->unsignedBigInteger('user_id');                         //links us to restaurant table
            $table->foreign('user_id')->references('id')->on('users');
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
        if(Schema::hasTable('user_cuisine_mappings')){
        Schema::dropIfExists('user_cuisine_mappings');
        }
    }
}
