<?php

use Illuminate\Database\Seeder;
use App\Model\Course;


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            'Antipasti',
            'Primi Piatti',
            'Secondi Piatti',
            'Contorni',
            'Dessert',
            'Bevande',
            'Birra',
            'Vino',
            'Colazione',
            'Insalata',
            'Carne',
            'Pesce',
            'Hamburgers',
            'Piadine',
            'Vegetariano',
            'Vegano',
            'Kebab',
            'Gelati',
            'Pizza',
        ];
        foreach ($courses as $course) {
            $newCourse = new Course();
            $newCourse->name = $course;
            $newCourse->save();
        }
    }
}
