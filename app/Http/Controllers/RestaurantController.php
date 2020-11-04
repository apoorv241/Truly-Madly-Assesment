<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserCuisineMapping;
use Illuminate\Support\Facades\Cache;
use App\Restaurant;
use App\CheckIn;
use Illuminate\Support\Arr;

class RestaurantController extends Controller
{
    public function suggestRestaurantstoUser(Request $request){
        try{
            $user=Auth::user();
            if(empty($user)){
                throw new \Exception('User not valid');
            }
            $user_id=$user->id;
            $cacheKey='restaurants'._METHOD_;
            $result=[];
            //Cache the restaurants since they wont change frequently
            //use laravel collection to create array with id as key
            $restaurants = Cache::get($cacheKey);
            if (!$restaurants) {
                $restaurants = Restaurant::get();
                $restaurants = collect($restaurants)->keyBy('id')->toArray();
                Cache::put($cacheKey,  $restaurants, 3600 * 7);
            }
            //Cuisine IDs for this user
            $restaurant_ids_for_user=UserCuisineMapping::join('restaurant_cuisine_mappings','restaurant_cuisine_mappings.cuisine_id','=','user_cuisine_mappings.restaurant_id')
            ->where('user_id',$user_id)
            ->pluck('restaurant_id');
            $result = Arr::where($restaurants, function ($value, $key) use ($restaurant_ids_for_user){
                return in_array($key,$restaurant_ids_for_user);
            });
            return $this->sendSuccessResponse($result,'Restaurant Recommendations fetched successfully');
        }catch(\Exception $ex){
            return $this->sendFailureResponse([],$ex->getMessage());
        }
    }


    public function topRatedrestaurans(Request $request){
        try{
           $city_id=$request->input('city_id');
           //Query to get checkins 
           $result=CheckIn::join('restaurants','restaurants.id','=','check_ins.restaurant_id')
                            ->where('restaurants.city_id',$city_id)
                            ->groupBy('city_id')
                            ->select('city_id','count(check_ins.id)')
                            ->orderBy('count(check_ins.id)','desc')
                            ->limit(5)->get(); 
           return $this->sendSuccessResponse($result,'Restaurant with highest checkins fetched successfully');
        }catch(\Exception $ex){
            return $this->sendFailureResponse([],$ex->getMessage());
        }
    }

    public function showWaitinginRestaurant(Request $request){
        try{
           $restaurant_id=$request->input('restaurant_id');
           //Query to get ccurrent heckins 
           $result=Restaurant::where('id',$restaurant_id)
                              ->withCount('currentCheckins')
                              ->get();
            if(empty($result) || count($result) == 0){
                throw new \Exception('No Restaurant available with given id');
            }  
            $capacity_left=Arr::get($result,'0.capacity')-Arr::get($result,'0.currentCheckins_count');                
           return $this->sendSuccessResponse($capacity_left,'Unfilled capacity fetched successfully');
        }catch(\Exception $ex){
            return $this->sendFailureResponse([],$ex->getMessage());
        }
    }
}
