<?php

use Illuminate\Database\Seeder;
use App\Model\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newOrder = new Order();
        $newOrder->date = '2022-03-23 12:00:00';
        $newOrder->customer_email = 'compratore@gmail.com';
        $newOrder->delivery_address = 'via palo, 34';
        $newOrder->payment_method = 'card';
        $newOrder->total_amount = 1;
        $newOrder->save();
    }
}
