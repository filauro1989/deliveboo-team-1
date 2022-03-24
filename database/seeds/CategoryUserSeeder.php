<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Model\Category;

class CategoryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurant = User::all()->first();
        $pizzaCategory = Category::where('name', 'Pizza')->first();

        // COLLEGA ID DEL RISTORANTE ALl'ID DELLA CATEGORIA NELLA TABELLA PONTE
        $restaurant->categories()->attach($pizzaCategory);
    }
}
