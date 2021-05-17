<?php

// use GuzzleHttp\Psr7\Request;

use App\Mail\OrderShipped;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('homepage-edo-vito');
});

Auth::routes();

Route::get('/home', 'Admin\RestaurantController@index')->name('home');
Route::get('/restaurant-orders/{restaurant}', 'Admin\RestaurantController@showOrders')->name('show.orders');
Route::get('/orders/store', 'Api\OrderController@store');
Route::get('/orders/index', 'Api\OrderController@index');
Route::resource('orders','Api\OrderController');

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
    Route::resource('restaurants', 'RestaurantController');
    Route::resource('plates', 'PlateController');


});

Route::get('/single-restaurant/{restaurant}', 'SingleRestaurantController@singleRestaurant')
    ->name('single-restaurant');

// Route::get('/payments', function () {
//     return view('payments');
// });

// Route::get("/payment/make", "PaymentsController@make")->name("payment.make");

// ---------------------------------------------------------------------------------------
// roba di braintree PROVA

Route::get('/hosted', function () {
    $gateway = new Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId' => 'r7czy6mhvckbb4v2',
        'publicKey' => 'v9nnbkhz2k4pjb38',
        'privateKey' => '133733e02f2f5a3e202dfcfbac16d9b2'
      ]);

    $token = $gateway->ClientToken()->generate();

    return view('payments', [
        'token' => $token
    ]);
});

Route::post('/checkout', function (Request $request) {
    $gateway = new Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId' => 'r7czy6mhvckbb4v2',
        'publicKey' => 'v9nnbkhz2k4pjb38',
        'privateKey' => '133733e02f2f5a3e202dfcfbac16d9b2'
      ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'customer' => [
            'firstName' => 'Tony',
            'lastName' => 'Stark',
            'email' => 'tony@avengers.com',
        ],
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: transaction.php?id=" . $transaction->id);
        $data = $request->all();
        $currentRestaurant = $data['restaurant_id'];
        $Order = new Order();
        $Order->fill($data);
        $Order->status = 1;
        $Order->restaurant_id = $currentRestaurant;
        $Order->total = $data['amount'];
        $Order->save();
        $Order->plates()->attach($data['plates']);
        // Mail::to($data['mail'])->send(new OrderShipped());
        return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");
        return back()->withErrors('An error occurred with the message: '.$result->message);
    }
});
