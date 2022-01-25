<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Room;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function template(){
        return view('landing.template');
    }
    public function home(){
        $facilities = Facility::all();
        $rooms = Room::all();

        $compact = compact('facilities','rooms');
        return view('landing.home')->with($compact);
    }
}
