<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

class SingleRestaurantController extends Controller
{
    public function singleRestaurant(Restaurant $restaurant){
        return view('single-restaurant', compact('restaurant'));
    }
}
