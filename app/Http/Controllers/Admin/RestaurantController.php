<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Chart;
use App\Http\Controllers\Controller;
use App\Order;
use App\Restaurant;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = Auth::user();

        $userRestaurants = Restaurant::where('user_id', $currentUser->id)->get();

        return view('home', compact('userRestaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        return view('auth.create-restaurant',compact('categories'));
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

        $currentUser = Auth::user();
        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);
        $newRestaurant->user_id = $currentUser->id;
        $newRestaurant->save();
        $newRestaurant->categories()->attach($data['categories']);
        return redirect()->route('restaurants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('this-restaurant', compact('restaurant'));
    }

    public function showOrders(Restaurant $restaurant)
    {
            $thisRestaurantOrder=[];
            $january=[];
            $february=[];
            $march=[];
            $april=[];
            $may=[];
            $june=[];
            $july=[];
            $august=[];
            $september=[];
            $october=[];
            $november=[];
            $december=[];

            $ordersStats = Order::all();
            foreach ($ordersStats as $order ) {
               if($order->restaurant_id == $restaurant->id){
                $thisRestaurantOrder[] = $order;
               }
            }
           foreach ($thisRestaurantOrder as $key => $thisOrder) {

            if(substr($thisOrder->created_at, 5,2) == '01'){
                 $january[] = $thisOrder;
              }
            if(substr($thisOrder->created_at, 5,2) == '02'){
                 $february[] = $thisOrder;
            }
            if(substr($thisOrder->created_at, 5,2) == '03'){
                 $march[] = $thisOrder;
            }
            if(substr($thisOrder->created_at, 5,2) == '04'){
                $april[] = $thisOrder;
            }
            if(substr($thisOrder->created_at, 5,2) == '05'){
                $may[] = $thisOrder;
            }
            if(substr($thisOrder->created_at, 5,2) == '06'){
                $june[] = $thisOrder;
            }
            if(substr($thisOrder->created_at, 5,2) == '07'){
                $july[] = $thisOrder;
            }
            if(substr($thisOrder->created_at, 5,2) == '08'){
                $august[] = $thisOrder;
            }
            if(substr($thisOrder->created_at, 5,2) == '09'){
                $september[] = $thisOrder;
            }
            if(substr($thisOrder->created_at, 5,2) == '10'){
                $october[] = $thisOrder;
            }
            if(substr($thisOrder->created_at, 5,2) == '11'){
                $november[] = $thisOrder;
            }
            if(substr($thisOrder->created_at, 5,2) == '12'){
                $december[] = $thisOrder;
            }
        }

                 for ($i=0; $i <= 12; $i++) {
                    $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                }
                // Prepare the data for returning with the view
                $chart = new Chart();
                $chart->labels = ['Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'];
                $chart->dataset = [count($january),count($february),count($march),count($april),count($may),count($june),count($july),count($august),count($september),count($october),count($november),count($december)];
                $chart->colours = $colours;

        return view('orders', compact('restaurant'))->with('chart', $chart);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $categories= Category::all();

        return view('auth.edit-restaurant', compact('restaurant','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $data = $request->all();
        $restaurant->update($data);

        return redirect()->route('restaurants.show', compact('restaurant'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect()->route('restaurants.index');
    }
}
