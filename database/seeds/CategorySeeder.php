<?php

use Illuminate\Database\Seeder;
use App\Model\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
                [
                    'name' => 'Argentino',
                    'img'=> 'categories_img/argentino.jpg',
                ],
                [
                    'name' => 'Bar e Caffetteria',
                    'img'=> 'categories_img/bar_caffetteria.jpg',
                ],
                [
                    'name' => 'Bevande',
                    'img'=> 'categories_img/bevande.jpg',
                ],
                [
                    'name' => 'Brasiliano',
                    'img'=> 'categories_img/brasiliano.jpg',
                ],
                [
                    'name' => 'Cinese',
                    'img'=> 'categories_img/cinese.jpg',
                ],
                [
                    'name' => 'Dolci e dessert',
                    'img'=> 'categories_img/dessert.jpg',
                ],
                [
                    'name' => 'Fast food',
                    'img'=> 'categories_img/fast_food.jpg',
                ],
                [
                    'name' => 'Gelato',
                    'img'=> 'categories_img/gelato.jpeg',
                ],
                [
                    'name' => 'Giapponese',
                    'img'=> 'categories_img/giapponese.jpeg',
                ],
                [
                    'name' => 'Greco',
                    'img'=> 'categories_img/greco.jpg',
                ],
                [
                    'name' => 'Hamburger',
                    'img'=> 'categories_img/hamburger.jpg',
                ],
                [
                    'name' => 'Healthy',
                    'img'=> 'categories_img/healthy_food.jpeg',
                ],
                [
                    'name' => 'Indiano',
                    'img'=> 'categories_img/indiano.jpg',
                ],
                [
                    'name' => 'Italiano',
                    'img'=> 'categories_img/italiano.png',
                ],
                [
                    'name' => 'Kebab',
                    'img'=> 'categories_img/kebab.jpg',
                ],
                [
                    'name' => 'Messicano',
                    'img'=> 'categories_img/messicano.jpg',
                ],
                [
                    'name' => 'Panetteria',
                    'img'=> 'categories_img/panetteria.jpg',
                ],
                [
                    'name' => 'Pizza',
                    'img'=> 'categories_img/pizza.jpg',
                ],
                [
                    'name' => 'Poke',
                    'img'=> 'categories_img/poke.jpg',
                ],
                [
                    'name' => 'Steakhouse BBQ',
                    'img'=> 'categories_img/bbq.jpg',
                ],
                [
                    'name' => 'Sushi',
                    'img'=> 'categories_img/sushi.jpg',
                ],
                [
                    'name' => 'Thailandese',
                    'img'=> 'categories_img/thai.jpg',
                ],
        ];

        foreach ($categories as $category) {
            
            $newCategory = new Category();
            $newCategory->name = $category['name'];
            $newCategory->image = $category['img'];
            $newCategory->save();
        }
    }
}
