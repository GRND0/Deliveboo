<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // relazione molti a molti con Dish
    public function dishes() {
        return $this->belongsToMany('App\Dish');
    }
}
