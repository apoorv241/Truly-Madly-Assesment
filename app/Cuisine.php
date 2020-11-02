<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    protected $table='cuisines';

    //A cuisine has got many foods affliated to it 
    public function foods(){
        return $this->hasMany('App\Food','cuisine_id','id');
    }
}
