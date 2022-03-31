<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Category;

class ApiRestaurantController extends Controller
{
    public function sendRestaurantsData()
    {
        $restaurants = User::all();

        return response()->json([
            "success" => true,
            "results" => $restaurants,
        ]);
    }

    public function sendFilteredRestaurantsData(Request $request)
    {
        // $restaurants = User::all();

        // SPECIFICO restaurants COME DATO RICHIESTO ALL'API SELEZIONANDO categoriesArray(params della chiamata axios)
        $categories = $request->categoriesArray;

        $restaurants = [];
        $allCategories = true;

        foreach ($categories as $category) {
            $myrestaurants = Category::where('name', $category)->first()->users()->get();


            foreach ($myrestaurants as $singleRestaurant) {
                // if ($singleRestaurant->category->name == $category) {
                // }
                array_push($restaurants, $singleRestaurant);
            }
        }

        // $categoria = $restaurants[0]->categories()->first()->name;
        $finaleRestaurants = [];
        foreach ($restaurants as $restaurant) {
            foreach ($categories as $category) {
                // foreach ($categories as $category) {
                // if ($category != $restaurantCategory->name) {
                if (!in_array($category, $restaurant->categories()->get())) {

                    $allCategories = false;
                }
                // array_push($finaleRestaurants, $restaurant);
                // }
            }
            if ($allCategories) {
                array_push($finaleRestaurants, $restaurant);
            }
            $allCategories = true;
        }
        // if ($allCategories) {
        //     array_push($finaleRestaurants, $restaurant);
        // }
        // $allCategories = true;

        return response()->json([
            "success" => true,
            "results" => $finaleRestaurants,
        ]);
    }
}




// $finaleRestaurants = [];
// foreach ($restaurants as $restaurant) {
//     foreach ($restaurant->categories()->get() as $restaurantCategory) {

//         if (in_array($restaurantCategory, $categories)) {

//             $allCategories = false;
//         }
//     }
//     if ($allCategories) {
//         array_push($finaleRestaurants, $restaurant);
//     }
//     $allCategories = true;
// }