<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// CREO ROTTA orders/data nella quale richiamo la funzione sendOrdersData dall' ApiOrderController
Route::post("orders/data", "Api\ApiOrderController@sendOrdersData");
Route::get("categories/data", "Api\ApiCategoryController@sendCategoriesData")->middleware('api.auth');
Route::get("restaurants/data", "Api\ApiRestaurantController@sendRestaurantsData")->middleware('api.auth');
Route::get("restaurants/filtered", "Api\ApiRestaurantController@sendFilteredRestaurantsData")->middleware('api.auth');
// Route::get("restaurants/filter/{id}", "Api\ApiRestaurantController@findRestaurantMenu")->middleware('api.auth');
Route::get("restaurants/filter/{slug}", "Api\ApiRestaurantController@findRestaurantMenu")->middleware('api.auth');
// CREO ROTTA IN POST PER RENDERE ANONIMI I PARAMETRI
Route::post("checkout/payment", "Api\ApiOrderController@makeOrder")->middleware('api.auth');
