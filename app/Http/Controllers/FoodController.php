<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;

class FoodController extends Controller
{
    public function getTastebudsMatching(Request $request){
        try{
            $match=$request->input('match');
            //Logic match food names with inputs
            $foods_match=Food::where('like',"%".$match."%")->get();
            return $this->sendSuccessResponse($foods_match,'Food Matches fetched successfully');
        }catch(\Exception $ex){
            return $this->sendFailureResponse([],$ex->getMessage());
        }
    }
}
