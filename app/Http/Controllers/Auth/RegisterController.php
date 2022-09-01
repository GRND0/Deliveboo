<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use App\CategoryUser;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
            'restaurant_name' => ['required', 'string', 'max:255'],
            'restaurant_phone' => ['unique:users', 'required', 'string', 'max:255'],
            'link_social_media' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'p_iva' => ['unique:users', 'required', 'string', 'min:13', 'max:13'],
            'image' => ['required', 'image'],
            'category' => ['required'],
        ], [
            'email.unique' => 'L\'email inserita è già in uso',
            'password.confirmed' => 'Le password non corrispondono',
            'password.min' => 'Le password deve essere di almeno 4 caratteri',
            'p_iva.unique' => 'La Partita IVA inserità è già in uso',
            'p_iva.min' => 'La Partita IVA deve essere di 13 caratteri',
            'p_iva.max' => 'La Partita IVA deve essere di 13 caratteri',
            'restaurant_phone.unique' => 'Numero già in uso',
            'image.image' => 'immagine non valida',
            'category.required' => 'Devi selezionare almeno una categoria',
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
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'restaurant_name' => $data['restaurant_name'],
            'restaurant_phone' => $data['restaurant_phone'],
            'link_social_media' => $data['link_social_media'],
            'address' => $data['address'],
            'p_iva' => $data['p_iva'],
            'image' => Storage::put('uploads', $data['image']),
            'slug' => Str::slug($data['restaurant_name'], '-'),
        ]);

        $category = $data['category'];
        $user->categories()->attach($category);

        return $user;
    }

    // private function generateSlugFromName($restaurant_name) {
    //     $base_slug = Str::slug($restaurant_name, '-');
    //     $slug = $base_slug;
    //     $i = 1;
    //     $restaurant_same_name = User::where('slug', '=', $slug)->first();
    //     while ($restaurant_same_name) {
    //         $slug = $base_slug . '-' . $i;
    //         $restaurant_same_name = User::where('slug', '=', $slug)->first();
    //         $i++;
    //     }
    //     return $slug;
    // }

    public function chooseCategory(User $user){

        $categories = Category::all();

        return view('auth.register', compact('categories', 'user'));
    }

}