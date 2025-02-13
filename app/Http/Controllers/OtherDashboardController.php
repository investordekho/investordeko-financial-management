<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherDashboardController extends Controller
{
    public function index()
    {
        // Ensure the view name is 'dashboard.other_dashboard'
        return view('dashboard');
    }
}
