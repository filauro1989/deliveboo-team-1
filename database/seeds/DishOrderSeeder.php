<?php

use Illuminate\Database\Seeder;
use App\Model\Order;
use App\Model\Dish;


class DishOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = Order::all()->first();
        $dish = Dish::where('name', 'margherita')->get();
        
        // $piatto = [
        //     'dish_id' => $dish->id,
        //     'quantity' => 2,
        // ];

        // COLLEGA ID DEL RISTORANTE ALl'ID DELLA CATEGORIA NELLA TABELLA PONTE
        $order->dishes()->attach($dish, ['quantity' => 2]);
    }
}
