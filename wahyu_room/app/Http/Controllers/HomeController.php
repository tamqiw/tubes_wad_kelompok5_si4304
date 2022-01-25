<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect('/admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 1) {
            return redirect('/admin');
        }
        if (Auth::user()->role == 3) {
            return redirect('/user');
        }
    }

    public function admin()
    {
        return view('home.admin');
    }
    public function user()
    {
        $rooms = Room::all();
        $facilities = Facility::all();

        return view('home.user')->with(compact('rooms',
        'facilities'));
    }
}
