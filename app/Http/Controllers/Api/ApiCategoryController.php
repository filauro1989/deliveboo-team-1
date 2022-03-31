<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;

class ApiCategoryController extends Controller
{
    public function sendCategoriesData(){
        $categories = Category::all();
        
        return response()->json([
            "success" => true,
            "results" => $categories,
        ]);
    }
}