<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('total_price' , 6 ,2)->unsigned()->default(0);
            // $table->bigInteger('restaurant_id')->unsigned();
            $table->foreignId('restaurant_id')->constrained();
            $table->boolean('payment')->default(false);
            $table->dateTime('date');
            $table->string('customer_name');
            $table->string('customer_lastname');
            $table->string('customer_phone')->unique();
            $table->string('customer_address');
            $table->string('customer_email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
