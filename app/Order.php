<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['address', 'customer_name'];

    public function plates(){
        return $this->belongsToMany('App\Plate');
    }
    public function restaurat(){
        return $this->belongsTo('App\Restaurant');
    }
}
