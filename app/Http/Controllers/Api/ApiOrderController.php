<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        return response()->json([
            "success" => true,
            "results" => $orders,
        ]);
    }

    
}
