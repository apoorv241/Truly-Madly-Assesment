<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table='foods';

    //A food has got belongs to one cuisine 
    public function cuisine(){
        return $this->belongsTo('App\Cuisine','id','cuisine_id');
    }
}
