<?php

namespace App\Http\Controllers;

use App\Models\LocationDetailnew;
use Illuminate\Http\Request;

class LocationDetailnewController extends Controller
{
    public function getLocations()
    {
        $locations = LocationDetailnew::all(); // Fetch all locations
        return view('dashboard.banker', compact('locations'));
    }
}
