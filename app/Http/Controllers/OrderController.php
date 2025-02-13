<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrderPage(Request $request)
    {
        $plan = $request->query('plan');
        return view('order', compact('plan'));
    }
}
