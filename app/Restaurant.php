<?php

namespace App;
use App\CheckIn;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    
    public function currentCheckins(){
        return $this->hasMany('App\CheckIn','restaurant_id','id')->whereNull('check_out_time');
    }
}
