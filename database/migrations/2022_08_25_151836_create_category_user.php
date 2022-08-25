<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('category_user', function (Blueprint $table) {
            
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('category_id', 'categories_users')
                ->references('id')
                ->on('categories');

            $table->foreign('user_id', 'users_categories')
                ->references('id')
                ->on('users');

            $table->primary(['category_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_user');
    }
}
