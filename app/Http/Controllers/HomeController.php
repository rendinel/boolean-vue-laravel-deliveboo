<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
use App\Restaurant;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentUser = Auth::user();

        $userRestaurants = Restaurant::where('user_id', $currentUser->id)->get();

        return view('home', compact('userRestaurants'));
    }
}
