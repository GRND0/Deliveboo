<?php

use App\Dish;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
        $names = [
            "Gnocchi al pesto", 
            "Gnocchi di patate", 
            "Pasta all'arrabbiata", 
            "Cacio e pepe", 
            "Spaghetti alla carbonara", 
            "Tortellini al burro", 
            "Lasagna a 8 strati", 
            "Risotto allo zafferano", 
            "Fiorentina", 
            "Tagliata di manzo", 
            "Filetto intero di vitello", 
            "Involtini di manzo affumicato con ricotta", 
            "Branzino con zucchine", 
            "Tartare di salmone", 
            "Insalatina di gambero al vapore",
            "Sashimi Ikebana",
            "Maki roll California", 
            "Carpaccio di cervo affumicato", 
            "Verdure grigliate", 
            "Pizza margherita", 
            "Pizza 4 stagioni", 
            "Pizza 4 formaggi", 
            "Pizza capricciosa", 
            "Pizza con funghi", 
            "Pizza con prosciutto cotto", 
            "Pizza bufalina", 
            "Pizza pistacchiosa", 
            "Pizza salsiccia e friarielli",
            "Focaccia liscia", 
            "Calzone", 
            "Gelato della casa", 
            "Tiramisù", 
        ];

        $user_ids = User::pluck('id')->toArray();

        for ($i = 1; $i < count($names); $i++) {
            $dish = new Dish(); 
            $dish->name = $faker->unique()->randomElement($names);
            $dish->description = $faker->paragraph(3, false);
            $dish->ingredients = $faker->words(8, true);
            $dish->price = $faker->randomFloat(1, 3, 25);
            $dish->user_id = $faker->randomElement($user_ids);
            $dish->available = $faker->boolean();
            $dish->slug = Str::slug($dish->name, '-');
            $dish->save();
        }
    }
}
