<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

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

        $restaurants = null;

        // foreach ($variable as $key => $value) {
        //     # code...
        // }

        return response()->json([
            "success" => true,
            "results" => $request,
        ]);
    }
}
