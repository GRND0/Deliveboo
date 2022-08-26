<?php

use App\Dish;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $dish = new Dish(); 
            $dish->name = $faker->words(2, true);
            $dish->description = $faker->paragraph(rand(10, 30), false);
            $dish->ingredients = $faker->words(5, true);
            $dish->price = $faker->randomFloat(2, 1, 25);
            $dish->user_id = $faker->numberBetween(1, 10);
            $dish->available = $faker->boolean();
            $dish->save();
        }
    }
}
