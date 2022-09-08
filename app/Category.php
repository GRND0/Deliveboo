<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    // relazione molti a molti con User
    public function users() {
        return $this->belongsToMany('App\User')->withPivot('category_id');
    }
}
