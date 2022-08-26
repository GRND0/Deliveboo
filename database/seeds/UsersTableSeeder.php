<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->name = $faker->name();
            $user->restaurant_name = $faker->company();
            $user->restaurant_phone = $faker->phoneNumber();
            $user->address = $faker->address();
            $user->p_iva = $faker->unique->vatId();
            $user->slug = Str::slug($user->restaurant_name, '-');
            $user->link_social_media = $faker->url();
            $user->email = $faker->unique()->safeEmail;
            $user->password = $faker->password();
            $user->remember_token = Str::random(10);
            $user->save();
        }
    }
}
