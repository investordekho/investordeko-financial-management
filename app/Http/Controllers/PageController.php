<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // About Us page
    public function about()
    {
        return view('about');
    }

    // Contact Us page
    public function contact()
    {
        return view('contact');
    }

    // Our Services page
    public function services()
    {
        return view('services');
    }

    // Terms & Conditions page
    public function terms()
    {
        return view('terms');
    }

    // Support page
    public function support()
    {
        return view('support');
    }

    // Privacy Policy page
    public function privacy()
    {
        return view('privacy');
    }
}
?>
