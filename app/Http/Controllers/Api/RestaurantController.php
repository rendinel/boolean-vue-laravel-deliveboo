<?php

namespace App\Http\Controllers\Api;

use App\Restaurant;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $data = Restaurant::all();
        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function search(Request $request)
    {
        $str = $request->str;
        $restaurant = Restaurant::orderBy('id','desc')->with(['categories'])->select('id', 'business_name', 'pic_url', 'address', 'description', 'opening_hours');
           $restaurant->where('business_name', $str )
           ->orWhereHas('categories',function($q) use($str){
               $q->where('name',$str);
           });
        $finalArray= $restaurant->get();
        return response()->json($finalArray);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
