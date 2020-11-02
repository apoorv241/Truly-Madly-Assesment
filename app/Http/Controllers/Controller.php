<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Method to use whenever we want yo send success response
    public function sendSuccessResponse($data=[],$message=null){    
        return ['code'=>'success','data'=>[],'message'=>$message];
    }

    //Method to use whenever we want yo send dailed response
    public function sendFailureResponse($data=[],$message=null){    
        return ['code'=>'failed','data'=>$data,'message'=>$message];
    }
}
