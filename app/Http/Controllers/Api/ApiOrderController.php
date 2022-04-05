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
        $userForm = $request->params['form'];
        $userCart = $request->params['form']['cartStorage'];

        $today = new Carbon();

        // CREO NUOVO ORDINE
        $newOrder = new Order();
        $newOrder->first_name = $userForm['name'];
        $newOrder->last_name = $userForm['surname'];
        $newOrder->date = $today->now();
        $newOrder->customer_email = $userForm['mail'];
        $newOrder->delivery_address = $userForm['address'];
        $newOrder->payment_method = 'Credit Card';
        $newOrder->total_amount = $userForm['totalAmount'];
        $newOrder->save();

        // CICLO SU TUTTI GLI ELEMENTI DEL CARRELLO
        foreach ($userCart as $cartElement) {

            // COLLEGO L'ID DI OGNI cartElement E PASSO ANCHE LA COLONNA quantity COLLEGANDOLA ALLA QUANTITà DELL'ELEMENTO
            $newOrder->dishes()->attach($cartElement['id'], ['quantity' => $cartElement['quantity']]);
        }


        return response()->json([
            "success" =>true,
            "results" => $newOrder,
        ]);
    }
}
