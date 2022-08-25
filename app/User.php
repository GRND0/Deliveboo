<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // relazione molti a molti con Category
    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    // relazione 1 a molti con Dish
    public function dishes() {
        return $this->hasMany('App\Dish');
    }

    // relazione 1 a molti con Order (per ridondanza)
    public function orders() {
        return $this->hasMany('App\Order');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
