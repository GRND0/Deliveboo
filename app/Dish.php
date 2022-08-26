<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{

    protected $fillable = [
        'name',
        'description',
        'ingredients',
        'price',
        'user_id',
        'available',
        'image'
    ];

    // relazione 1 (user) a molti (dish)
    public function user() {
        return $this->belongsTo('App\User');
    }

    // relazione molti a molti con Order
    public function orders() {
        return $this->belongsToMany('App\Order');
    }
}
