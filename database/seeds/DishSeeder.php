<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Model\Dish;
use App\Model\Course;
use Illuminate\Support\Str;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all()->first();
        $course = Course::where('name', 'Pizza')->first();
        $newDish = new Dish();
        $newDish->user_id = $user->id;
        $newDish->course_id = $course->id;
        $newDish->name = 'margherita';
        $newDish->description = 'Pizza margherita con pomodoro mozzarella e tanto basilico';
        $newDish->price = 5.25;
        $newDish->image = 'dishes_img/margherita.jpg';
        $newDish->visible = 1;
        $newDish->slug = Str::slug($newDish->name . '-');
        $newDish->save();
    }
}
