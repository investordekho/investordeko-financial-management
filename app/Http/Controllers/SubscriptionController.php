<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class SubscriptionController extends Controller
{
 public function index()
{
    // Get values from session
    $max_investors_can_subscribe = session('max_investors_can_subscribe', 0);
    $max_investees_can_subscribe = session('max_investees_can_subscribe', 0);

    // Convert to numbers (if array → count | if string → int | if null → 0)
    $investors_count = is_array($max_investors_can_subscribe)
        ? count($max_investors_can_subscribe)
        : intval($max_investors_can_subscribe);

    $investees_count = is_array($max_investees_can_subscribe)
        ? count($max_investees_can_subscribe)
        : intval($max_investees_can_subscribe);

    // Find max
    $max_count = max($investees_count, $investors_count);

    // Log properly
    Log::info('Subscription counts:', [
        'investors_count' => $investors_count,
        'investees_count' => $investees_count,
        'max_count'       => $max_count,
    ]);

    return view('subscription', compact('max_count'));
}


}
