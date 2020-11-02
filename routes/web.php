<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Routes for restaurant controller
Route::middleware('auth:api')->prefix('restaurant')->group(function () {
    Route::get('/suggest_retaurants', 'RestaurantController@suggestRestaurantstoUser');
    Route::get('/get_top_rated_restaurants', 'RestaurantControlle@topRatedrestaurants');
    Route::get('/show_waiting_in_restaurant', 'RestaurantControlle@showWaitinginRestaurant');
});

//Routes for food controller
Route::middleware('auth:api')->prefix('food')->group(function () {
    Route::get('/get_matching_tastebuds', 'FoodController@getTastebudsMatching');
 });

