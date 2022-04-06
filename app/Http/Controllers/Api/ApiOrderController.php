<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Model\Order;
use App\Model\Dish;
use App\User;
use App\Lead;
use App\Mail\SendNewMail;
use App\Mail\SendRestaurantMail;
use Carbon\Carbon;


class ApiOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendOrdersData(Request $request)
    {
        $restaurantId = $request->params["id"][0];
        // $orders = Order::all();


        $orders = DB::table("orders")
            ->select("orders.*")
            ->distinct()
            ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
            ->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
            ->where("user_id", $restaurantId) //Auth::user()->id non gli piace, bisognerà passargli dei parametri dall'home
            ->get();


        return response()->json([
            "success" => true,
            "results" => $orders,
        ]);
    }

    public function makeOrder(Request $request)
    {
        // INSERISCO PARAMS RICEVUTI TRAMITE REQUEST DEL FORM NELLA VARIABILE info
        $userForm = $request->params['form'];
        $userCart = $request->params['form']['cartStorage'];


        $validation = $userForm->validate(
            [
                "name" => "required|max:255|profane:it",
                "surname" => "required|max:255|profane:it",
                "email" => "require|email",
                "address" => "required|max:255"
            ],
            [
                'profane' => "Volgarità rilevata nel testo inserito",
                'required' => "Questo campo è obbligatorio"
            ]
        );
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

        // CREO NUOVO MODEL PER INVIARE MAIL ALL'UTENTE CHE COMPRA
        $newLead = new Lead();
        $newLead->name = $userForm['name'];
        $newLead->mail = $userForm['mail'];
        $newLead->save();
        Mail::to($userForm['mail'])->send(new SendNewMail($newLead));

        // PRENDO IL PRIMO PIATTO CON ID UGUALE ALL'ORDINE CHE è NEL userCart
        $dish = Dish::where('id', $userCart[0]['id'])->first();

        // PRENDO LA MAIL  DELLO USER CON ID UGUALE AL dish_id
        $restaurant = User::where('id', $dish->user_id)->first();

        // CREO NUOVO MODEL PER INVIARE MAIL AL RISTORANTE
        $restaurantLead = new Lead();
        $restaurantLead->name = $restaurant->restaurant_name;
        $restaurantLead->mail = $restaurant->email;
        $restaurantLead->save();
        Mail::to($restaurant->email)->send(new SendRestaurantMail($restaurantLead));

        return response()->json([
            "success" => true,
            "results" => $newOrder,
        ]);
    }
}
