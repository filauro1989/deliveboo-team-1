<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Category;

class ApiRestaurantController extends Controller
{
    public function sendRestaurantsData(){
        $restaurants = User::all();

        return response()->json([
            "success" => true,
            "results" => $restaurants,
        ]);
    }

    public function sendFilteredRestaurantsData(Request $request){
        // $restaurants = User::all();

        // SPECIFICO restaurants COME DATO RICHIESTO ALL'API SELEZIONANDO categoriesArray(params della chiamata axios)
        $categories = $request->categoriesArray;

        $restaurants = [];
        $allCategories = true;
        
        foreach ($categories as $category) {
            $myrestaurants = Category::where('name', $category)->first()->users()->get();
            foreach ($myrestaurants as $singleRestaurant) {
                
            }
            // if (condition) {
            //     array_push($restaurants, $myrestaurants);
            // }

        }

        return response()->json([
            "success" => true,
            "results" => $restaurants,
        ]);
    }
}
