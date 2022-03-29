<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Model\Order;

class ApiOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendOrdersData()
    {   
        $orders = Order::all();
        // $orders = DB::table("orders")
        // ->select("orders.*")
        // ->distinct()
        // ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
        // ->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
        // ->where("user_id", Auth::user()->id) //Auth::user()->id non gli piace, bisognerà passargli dei parametri dall'home
        // ->get();
        

        return response()->json([
            "success" => true,
            "results" => $orders,
        ]);
    }

    
}
