<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showOrderPage(Request $request)
    {
        $plan = $request->query('investors');
        $totalprice = $request->query('price');
        return view('order', compact('plan', 'totalprice'));
    }
    public function processOrder($plan ,$totalprice)
    {
                
        return view('payment.paymentcredentials',compact('plan', 'totalprice'));
       
    }
}
