<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new User();
        $newUser->restaurant_name = 'Admin';
        $newUser->email = 'admin@deliveboo.it';
        $string = '12345678';
        $newUser->password = Hash::make($string);
        $newUser->address = 'via casa mia, 5';
        $newUser->phone = '333999666';
        $newUser->vat = 'IT123456789';
        $newUser->image = 'users_img/restaurant_admin';
        $newUser->description = 'ipografo prese una cassetta di caratteri e li assemblò per preparare un testo campione. È sopravvissuto non solo a più di cinque secoli, ma anche al passaggio alla videoimpaginazione, pervenendoci sostanzialmente inalterato. Fu reso popolare, negli anni ’60, con la diffusione dei fogli di caratteri trasferibili “Letraset”, che contenevano passaggi del Lorem Ip';
        $newUser->opening_time = '08:00';
        $newUser->closing_time = '23:30';
        $newUser->closing_days = 'Saturday';
        $newUser->open = 1;

        $newUser->save();
    }
}
