<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function performSearch(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please log in to continue your search.');
        }

        // If authenticated, process the search query
        $searchQuery = $request->input('search_query');
        $userCategory = Auth::user()->category; // Get user category from the session

        // Redirect to the appropriate dashboard based on user category with search query
        switch ($userCategory) {
            case 'Investee':
                return redirect()->route('investee.dashboard', ['search' => $searchQuery]);
            case 'Investor':
                return redirect()->route('investor.dashboard', ['search' => $searchQuery]);
            case 'Banker':
                return redirect()->route('banker.dashboard', ['search' => $searchQuery]);
            default:
                return redirect()->route('home')->with('message', 'User category not found.');
        }
    }
}
