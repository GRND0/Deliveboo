<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_restaurant', function (Blueprint $table) {
            
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('restaurant_id')->unsigned();

            $table->foreign('category_id', 'categories_restaurants')
                ->references('id')
                ->on('categories');

            $table->foreign('restaurant_id', 'restaurants_categories')
                ->references('id')
                ->on('restaurants');

            $table->primary(['category_id', 'restaurant_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_restaurant');
    }
}
