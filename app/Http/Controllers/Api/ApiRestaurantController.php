<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Category;
use App\Model\Dish;

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

        $categories = $request->categoriesArray;

        if (!empty($categories)) {


            // SPECIFICO restaurants COME DATO RICHIESTO ALL'API SELEZIONANDO categoriesArray(params della chiamata axios)

            $restaurants = [];

            foreach ($categories as $category) {
                $myrestaurants = Category::where('name', $category)->first()->users()->get();


                foreach ($myrestaurants as $singleRestaurant) {

                    array_push($restaurants, $singleRestaurant);
                }
            }

            $finaleRestaurants = [];
            $alreadyIn = [];
            $allCategories = true;

            foreach ($restaurants as $restaurant) {

                $restaurantCategoryName = [];

                $restaurantCategories = $restaurant->categories()->get();

                foreach ($restaurantCategories as $restaurantCategory) {
                    array_push($restaurantCategoryName, $restaurantCategory->name);
                }

                foreach ($categories as $category) {

                    if (!in_array($category, $restaurantCategoryName)) {

                        $allCategories = false;
                    }
                }
                if ($allCategories) {

                    if (!in_array($restaurant->id, $alreadyIn)) {
                        array_push($finaleRestaurants, $restaurant);
                        array_push($alreadyIn, $restaurant->id);
                    }
                }
                $allCategories = true;
            }
        } else {
            $finaleRestaurants = User::all();
        }


        return response()->json([
            "success" => true,
            "results" => $finaleRestaurants,
        ]);
    }

    public function findRestaurantMenu(Request $request) {

        $restaurantId = $request->id;

        $menu = Dish::where("user_id", $restaurantId)->get();



        return response()->json([
            "success" => true,
            "result" => $menu
        ]);
    }
}
