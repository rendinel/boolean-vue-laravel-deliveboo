<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Plate;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thisRestaurant= $_GET['restaurant'];
        return view('auth.create-plate',compact('thisRestaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $newPlate = new Plate();
        $newPlate->fill($data);

        $newPlate->save();
        $returnRestaurant = $newPlate->restaurant_id;

        return redirect()->route('restaurants.show', ['restaurant' => $returnRestaurant]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plate $plate)
    {
        $thisRestaurant= $plate->restaurant_id;

        return view('auth.edit-plate', compact('plate','thisRestaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Plate $plate)
    {
        $data = $request->all();
        $plate->update($data);
        $returnRestaurant=$plate->restaurant_id;
        return redirect()->route('restaurants.show', ['restaurant' => $returnRestaurant]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plate $plate)
    {
        $returnRestaurant = $plate->restaurant_id;

        $plate->delete();

        return redirect()->route('restaurants.show', ['restaurant' => $returnRestaurant]);
    }
}
