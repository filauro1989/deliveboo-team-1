<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Model\Order;
use Illuminate\Validation\Rules\Exists;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $orders = DB::table("orders")
        // ->select("orders.*")
        // ->distinct()
        // ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
        // ->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
        // ->where("user_id", Auth::user()->id)
        // ->get();
        // $orders2 = Order::all();
        // dd($orders);


        $allDishes = Dish::where('user_id', Auth::user()->id)->get();

        $orders = [];
        
        //faccio un giro su tutti i piatti del ristoratore
        foreach ($allDishes as $dish) {
            //ad order assegno tutti gli ordini collegati a quel piatto

            $order = $dish->orders()->get();
            //faccio un giro sugli ordini che restituisce l'istruzione sopra (può restituire un array di ordini se il piatto è collegato a più ordini)

            foreach ($order as $item) {
                //variabile booleana per sgamare se c'è già l'id dell'ordine singolo su cui sto girando

                $find = false;

                //giro sul mio array ordini dove pusho gli ordini che trovo
                for($i=0; $i<count($orders); $i++) {

                    //se l'id dell'ordine su cui sto girando viene trovato all'interno del mio array di ordini, la variabile find si setta su true, termino il ciclo
                    if($orders[$i]->id == $item->id) {
                        $find = true;
                        $i = count($orders);
                    }
                }
                //se la variabile è ancora false, e quindi non ho trovato nessun id, pusho l'ordine dentro il mio array ordini
                if(!$find) {
                    $orders[] = $item; 
                }
            } 
        }

        // dd($orders[0]->dishes()->first());

        return view("admin.orderlist", compact("orders"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
