<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Model\Order;
use Carbon\Carbon;

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

    public function makeOrder(Request $request) {
        // INSERISCO PARAMS RICEVUTI TRAMITE REQUEST DEL FORM NELLA VARIABILE info
        $info = $request->params['form'];
        $today = new Carbon();

        // CREO NUOVO ORDINE
        $newOrder = new Order();
        $newOrder->first_name = $info['name'];
        $newOrder->last_name = $info['surname'];
        $newOrder->date = $today->now();
        $newOrder->customer_email = $info['mail'];
        $newOrder->delivery_address = $info['address'];
        $newOrder->payment_method = 'Credit Card';
        $newOrder->total_amount = $info['totalAmount'];
        $newOrder->save();

        return response()->json([
            "success" =>true,
            "results" => $newOrder,
        ]);
    }
}
