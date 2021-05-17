<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $fillable = ['name', 'typology', 'description', 'price', 'visible','restaurant_id'];

    public function orders(){
        return $this->belongsToMany('App\Order');
    }

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }
}
