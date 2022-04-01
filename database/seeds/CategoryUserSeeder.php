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
        // chiamo tutti i ristoranti del db
        $restaurants = User::all();

        // giro su ogni ristorante
        foreach ($restaurants as $restaurant) {
            
            //assegno una categoria a caso
            $category = Category::inRandomOrder()->first();
            $restaurant->categories()->attach($category);
            
            // in modo randomico ne assegno una seconda
            if(rand(0, 1)) {
                $secondCategory = Category::inRandomOrder()->first();
                if($secondCategory != $category) {
                $restaurant->categories()->attach($secondCategory);
                }
            }
        }

    }
}


