<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total_price',
        'user_id',
        'payment',
        'date',
        'customer_name',
        'customer_lastname',
        'customer_phone',
        'customer_address',
        'customer_email'
    ];

    // relazione molti a molti con Dish
    public function dishes() {
        return $this->belongsToMany('App\Dish');
    }

    // relazione 1 a molti con user
    public function user() {
        return $this->belongsTo('App\User');
    }
}
