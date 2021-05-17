<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['business_name', 'restaurant_type', 'description', 'opening_hours', 'address', 'pic_url'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function plates(){
        return $this->hasMany('App\Plate');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }
}
