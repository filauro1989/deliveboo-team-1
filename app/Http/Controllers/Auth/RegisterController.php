<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Model\Category;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showRegistrationForm()
    {
        $categories = Category::all();
        return view('auth.register', ['categories' => $categories]);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'restaurant_name' => ['required', 'string', 'max:255', 'profane:it,en'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255', 'profane:it,en'],
            'phone' => ['required', 'numeric'],
            'vat' => ['required', 'digits:11', 'max:255', 'unique:users'],
            'image' => ['nullable', 'image'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'categories.*' => ['exists:App\Model\Category,id'],
            'categories' => ['required'],
        ], 
        [
            'profane' => "Volgarità rilevata nel testo inserito",
            'required' => "Questo campo è obbligatorio",
            'digits' => "La P.Iva deve essere di 11 caratteri",
            'password.confirmed' => "La Password non combacia",
            'password.min' => "La password deve contenere almeno 8 caratteri",
            'email.unique' => "Questa e-mail è già utilizzata",
            'vat.unique' => "Questa P.Iva è già utilizzata",
            'max' => "Hai superato il numero di caratteri consentiti",
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    
    {
        // CREAZIONE SLUG E CONTROLLO DUPLICATI
        $slug = Str::slug($data['restaurant_name'], '-');

        $oldUser = User::where('slug', $slug)->first();

        if (!$oldUser) {
            $newSlug = $slug;
        } else {
        $counter = 0;
            while ($oldUser) {
                $newSlug = $slug . '-' . $counter;
                $oldUser = User::where('slug', $newSlug)->first();
                $counter++;
            }
        }

        if (!empty($data['image'])) {
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = $img_path;
        } else {
            $data['image'] = 'null';
        }

        // return User::create([
        //     'restaurant_name' => $data['restaurant_name'],
        //     'email' => $data['email'],
        //     'address' => $data['address'],
        //     'phone' => $data['phone'],
        //     'vat' => $data['vat'],
        //     'image' => $data['image'],
        //     'password' => Hash::make($data['password']),
        //     'slug' => $newSlug,
        // ]);

        $user = User::create([
            'restaurant_name' => $data['restaurant_name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'vat' => $data['vat'],
            'image' => $data['image'],
            'password' => Hash::make($data['password']),
            'slug' => $newSlug,
        ]);

        // Aggiungo all'utente che si registra le varie categorie inserita nella checkbox collegandole con la tabella ponte
        $user->categories()->sync($data['categories']);

        return $user;
    }
}
