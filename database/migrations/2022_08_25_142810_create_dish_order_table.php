<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_order', function (Blueprint $table) {
            
            $table->bigInteger('dish_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();

            $table->foreign('dish_id', 'dishes_orders')
                ->references('id')
                ->on('dishes');

            $table->foreign('order_id', 'orders_dishes')
                ->references('id')
                ->on('orders');

            $table->primary(['dish_id', 'order_id']);

            $table->tinyInteger(('dish_quantity'))->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dish_order');
    }
}
