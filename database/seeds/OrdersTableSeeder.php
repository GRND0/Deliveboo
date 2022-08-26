<?php

use App\Order;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $order = new Order();
            $order->total_price = $faker->randomFloat(2, 1, 900);
            $order->user_id = $faker->numberBetween(1, 10);
            $order->payment = $faker->boolean();
            $order->date = $faker->dateTime();
            $order->customer_name = $faker->name();
            $order->customer_lastname = $faker->name();
            $order->customer_phone = $faker->phoneNumber();
            $order->customer_address = $faker->address();
            $order->customer_email = $faker->unique()->safeEmail;
            $order->save();


        }
    }
}
